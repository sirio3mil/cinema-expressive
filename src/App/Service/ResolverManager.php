<?php


namespace App\Service;

use App\Entity\CinemaEntity;
use App\Resolver\AbstractResolver;
use App\Type\CustomType;
use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use GraphQL\Doctrine\Annotation\Field;
use GraphQL\Doctrine\Definition\EntityID;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;

class ResolverManager
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var ReflectionClass
     */
    private $reflectionClass;
    /**
     * @var ReflectionMethod
     */
    private $reflectionMethod;
    /**
     * @var Types
     */
    private $types;
    /**
     * @var AnnotationReader
     */
    private $annotationReader;
    /**
     * @var string
     */
    private $entityNamespaceName;
    /**
     * @var string
     */
    private $typeNamespaceName;

    /**
     * ResolverManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->types = $this->container->get(Types::class);
        $this->annotationReader = $this->container->get(AnnotationReader::class);
        $this->entityNamespaceName = str_replace('CinemaEntity', '', CinemaEntity::class);
        $this->typeNamespaceName = str_replace('CustomType', '', CustomType::class);
    }

    /**
     * @param ReflectionClass $class
     * @return string
     */
    protected static function getEntityIdArgumentName(ReflectionClass $class): string
    {
        $argName = strtolower(substr($class->getShortName(), 0, 1)) . substr($class->getShortName(), 1) . 'Id';
        return $argName;
    }


    /**
     * @param string $resolverClassName
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function get(string $resolverClassName): array
    {
        $this->reflectionClass = new ReflectionClass($resolverClassName);
        $this->setReflectionMethod();

        $resolver = $this->getInstance($resolverClassName);
        $type = $this->getType();
        $args = $this->getArguments();

        return [
            'type' => $type,
            'args' => $args,
            'resolve' => function ($source, $args, $context) use ($resolver) {
                $resolver->setUser($context);
                $resolver->setSource($source);
                return $resolver->resolve($args);
            }
        ];
    }

    /**
     * @param string $resolverClassName
     * @return AbstractResolver
     */
    protected function getInstance(string $resolverClassName): AbstractResolver
    {
        $dynamicParameters = [];
        /** @var ReflectionMethod $constructor */
        $constructor = $this->reflectionClass->getConstructor();
        if ($constructor) {
            /** @var ReflectionParameter[] $parameters */
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                if ($parameterClass = $parameter->getClass()->getName()) {
                    $dynamicParameters[] = $this->container->get($parameterClass);
                }
            }
        }
        /** @var AbstractResolver $resolver */
        return new $resolverClassName(...$dynamicParameters);
    }

    /**
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getArguments(): array
    {
        $args = [];
        switch ($this->reflectionMethod->getName()) {
            case 'execute':
                /** @var ReflectionParameter[] $parameters */
                $parameters = $this->reflectionMethod->getParameters();
                foreach ($parameters as $parameter) {
                    $argType = null;
                    $argName = $parameter->getName();
                    /** @var ReflectionClass $class */
                    $class = $parameter->getClass();
                    if (!$class) {
                        switch ($parameter->getType()) {
                            case 'bool':
                                $argType = Type::boolean();
                                break;
                            default:
                                $argType = call_user_func(Type::class . '::' . $parameter->getType());
                        }
                    } elseif ($class->isSubclassOf(CinemaEntity::class)) {
                        $argType = $this->types->getId($class->getName());
                        $argName = self::getEntityIdArgumentName($class);
                    } else {
                        throw new Exception("Missing argument for {$this->reflectionClass->getShortName()}");
                    }
                    if (!$parameter->allowsNull()) {
                        $argType = Type::nonNull($argType);
                    }
                    $args[$argName] = $argType;
                }
                break;
            case 'resolve':
                $argType = null;
                $argName = null;
                /** @var ReflectionType $returnType */
                $returnType = $this->reflectionMethod->getReturnType();
                if (!$returnType) {
                    throw new Exception("Missing argument as return type for {$this->reflectionMethod->getShortName()}");
                }
                $class = new ReflectionClass($returnType->getName());
                if ($class->isSubclassOf(CinemaEntity::class)) {
                    $argType = $this->types->getId($class->getName());
                    $argName = self::getEntityIdArgumentName($class);
                }
                if (!$argType || !$argName) {
                    throw new Exception("Invalid argument as return type for {$this->reflectionMethod->getShortName()}");
                }
                $args[$argName] = $argType;
                break;
        }
        return $args;
    }

    /**
     * @return ListOfType|NonNull|ObjectType|null
     * @throws ReflectionException
     * @throws \GraphQL\Doctrine\Exception
     * @throws Exception
     */
    protected function getType()
    {
        $type = null;
        /** @var ReflectionType $returnType */
        $returnType = $this->reflectionMethod->getReturnType();

        if ($returnType instanceof ReflectionNamedType) {
            $name = $returnType->getName();
            switch ($name) {
                case 'array':
                    /** @var Field $annotation */
                    $annotation = $this->annotationReader->getMethodAnnotation($this->reflectionMethod, Field::class);
                    if (!$annotation) {
                        throw new Exception("Missing return type annotation for {$this->reflectionClass->getShortName()}");
                    }
                    if (stripos($annotation->type, "[]") !== false) {
                        $returnTypeClassName = str_replace("[]", "", $annotation->type);
                        $returnTypeClassName = $this->entityNamespaceName . $returnTypeClassName;
                        if (!class_exists($returnTypeClassName)) {
                            throw new Exception("Missing entity {$returnTypeClassName}");
                        }
                        $type = $this->types->getOutput($returnTypeClassName);
                        $type = Type::listOf($type);
                    } else {
                        $returnTypeClassName = $this->typeNamespaceName . $annotation->type;
                        if (!class_exists($returnTypeClassName)) {
                            throw new Exception("Missing custom type {$returnTypeClassName}");
                        }
                        $type = $this->types->get($returnTypeClassName);
                    }
                    break;
                default:
                    if (!class_exists($name)) {
                        throw new Exception("Missing class {$name}");
                    }
                    $class = new ReflectionClass($name);
                    if ($class->isSubclassOf(CinemaEntity::class)) {
                        $type = $this->types->getOutput($name);
                    } else {
                        throw new Exception("Missing type {$name}");
                    }
            }
        }
        if (!$returnType->allowsNull()) {
            $type = Type::nonNull($type);
        }
        return $type;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    protected function setReflectionMethod(): void
    {
        try {
            $this->reflectionMethod = $this->reflectionClass->getMethod('execute');
        } catch (ReflectionException $e) {
            $this->reflectionMethod = $this->reflectionClass->getMethod('resolve');
        }
        if (!$this->reflectionMethod->hasReturnType()) {
            throw new Exception("Reflection method not found for {$this->reflectionClass->getShortName()}");
        }
    }
}
