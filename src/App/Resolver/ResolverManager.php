<?php

namespace App\Resolver;

use App\Entity\CinemaEntity;
use App\Model\Argument;
use App\Type\CustomType;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\Collection;
use Exception;
use GraphQL\Doctrine\Annotation\Field;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use GraphQL\Upload\UploadType;
use JetBrains\PhpStorm\ArrayShape;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use function call_user_func;
use function class_exists;
use function str_replace;
use function stripos;
use function substr;

class ResolverManager
{
    private ReflectionClass $reflectionClass;
    private ReflectionMethod $reflectionMethod;
    private Types $types;
    private AnnotationReader $annotationReader;
    private string $entityNamespaceName;
    private string $typeNamespaceName;

    /**
     * ResolverManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(private ContainerInterface $container)
    {
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
        return strtolower($class->getShortName()[0]) . substr($class->getShortName(), 1) . 'Id';
    }


    /**
     * @param string $resolverClassName
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    #[ArrayShape(['type' => "mixed", 'args' => "array", 'resolve' => "\Closure"])]
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
                if ($context) {
                    $resolver->setUser($context);
                }
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
        $constructor = $this->reflectionClass->getConstructor();
        if ($constructor) {
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                if ($parameter->getName() === 'config') {
                    $dynamicParameters[] = (array)$this->container->get('config');
                } elseif ($parameter->getName() === 'responseFactory') {
                    $dynamicParameters[] = $this->container->get(ResponseInterface::class);
                } elseif ($parameterClass = $parameter->getClass()) {
                    $dynamicParameters[] = $this->container->get($parameterClass->getName());
                }
            }
        }
        /** @var AbstractResolver $resolver */
        return new $resolverClassName(...$dynamicParameters);
    }

    /**
     * @param ReflectionParameter $parameter
     * @return Argument
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getArgumentByParameter(ReflectionParameter $parameter): Argument
    {
        $argType = null;
        $argName = $parameter->getName();
        $class = $parameter->getClass();
        if (!$class) {
            $argType = $this->getArgumentTypeNoClass($parameter);
        } elseif ($class->isSubclassOf(CinemaEntity::class)) {
            switch ($argName) {
                case 'input':
                    $argType = $this->types->getPartialInput($class->getName());
                    break;
                default:
                    $argType = $this->types->getId($class->getName());
                    $argName = self::getEntityIdArgumentName($class);
            }
        } elseif ($class->implementsInterface(UploadedFileInterface::class)) {
            $argType = new UploadType();
        } else {
            throw new Exception("Missing argument for {$this->reflectionClass->getShortName()}");
        }
        if (!$parameter->allowsNull()) {
            $argType = Type::nonNull($argType);
        }
        if (!$argType || !$argName) {
            throw new Exception("Invalid argument as return type for {$this->reflectionMethod->getShortName()}");
        }

        return (new Argument())->setName($argName)->setType($argType);
    }

    /**
     * @return Argument
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getArgumentByReturnType(): Argument
    {
        $argType = null;
        $argName = null;
        /** @var ReflectionNamedType $returnType */
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

        return (new Argument())->setName($argName)->setType($argType);
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
                    $argument = $this->getArgumentByParameter($parameter);
                    $args[$argument->getName()] = $argument->getType();
                }
                break;
            case 'resolve':
                $argument = $this->getArgumentByReturnType();
                $args[$argument->getName()] = $argument->getType();
                break;
        }
        return $args;
    }

    /**
     * @return Type|null
     * @throws ReflectionException
     * @throws \GraphQL\Doctrine\Exception
     * @throws Exception
     */
    protected function getType(): ?Type
    {
        $type = null;
        /** @var ReflectionType $returnType */
        $returnType = $this->reflectionMethod->getReturnType();

        if ($returnType instanceof ReflectionNamedType) {
            $name = $returnType->getName();
            switch ($name) {
                case Collection::class:
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
        } catch (ReflectionException) {
            $this->reflectionMethod = $this->reflectionClass->getMethod('resolve');
        }
        if (!$this->reflectionMethod->hasReturnType()) {
            throw new Exception("Reflection method not found for {$this->reflectionClass->getShortName()}");
        }
    }

    /**
     * @param ReflectionParameter $parameter
     * @return mixed
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getArgumentTypeNoClass(ReflectionParameter $parameter): mixed
    {
        $argType = null;
        $reflectionType = $parameter->getType();
        if (!$reflectionType instanceof ReflectionNamedType) {
            throw new Exception("Wrong reflection type");
        }
        $parameterType = $reflectionType->getName();
        switch ($parameterType) {
            case 'bool':
                $argType = Type::boolean();
                break;
            case 'array':
                /** @var ReflectionNamedType $returnType */
                $returnType = $this->reflectionMethod->getReturnType();
                if (!$returnType) {
                    throw new Exception("Missing argument as return type for {$this->reflectionMethod->getShortName()}");
                }
                $class = new ReflectionClass($returnType->getName());
                if ($class->isSubclassOf(CinemaEntity::class)) {
                    $argType = $this->types->getPartialInput($class->getName());
                }
                break;
            default:
                $argType = call_user_func(Type::class . '::' . $parameterType);
        }

        return $argType;
    }
}
