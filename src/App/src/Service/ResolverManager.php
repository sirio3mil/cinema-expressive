<?php


namespace App\Service;

use App\Entity\CinemaEntity;
use App\Resolver\ResolverInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use GraphQL\Doctrine\Annotation\Field;
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
     * ResolverManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->types = $this->container->get(Types::class);
        $this->annotationReader = $this->container->get(AnnotationReader::class);
        $this->entityNamespaceName = str_replace('CinemaEntity', '', CinemaEntity::class);
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
        $this->reflectionMethod = $this->reflectionClass->getMethod('execute');
        if (!$this->reflectionMethod) {
            throw new Exception('TBD');
        }
        if (!$this->reflectionMethod->hasReturnType()) {
            throw new Exception('TBD');
        }

        $resolver = $this->getInstance($resolverClassName);
        $args = $this->getArguments();
        $type = $this->getType();

        return [
            'type' => $type,
            'args' => $args,
            'resolve' => function ($source, $args, $context) use ($resolver) {
                return $resolver->resolve($args);
            }
        ];
    }

    /**
     * @param string $resolverClassName
     * @return ResolverInterface
     */
    protected function getInstance(string $resolverClassName): ResolverInterface
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
        /** @var ResolverInterface $resolver */
        return new $resolverClassName(...$dynamicParameters);
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        $args = [];
        /** @var ReflectionParameter[] $parameters */
        $parameters = $this->reflectionMethod->getParameters();
        foreach ($parameters as $parameter) {
            $argType = null;
            if (!$parameter->getClass()) {
                $argType = call_user_func(Type::class . '::' . $parameter->getType());
            }
            if (!$parameter->allowsNull()) {
                $argType = Type::nonNull($argType);
            }
            $args[$parameter->getName()] = $argType;
        }
        return $args;
    }

    /**
     * @return ListOfType|NonNull|ObjectType|null
     */
    protected function getType()
    {
        $type = null;
        /** @var ReflectionType $returnType */
        $returnType = $this->reflectionMethod->getReturnType();

        if ($returnType instanceof ReflectionNamedType) {
            switch ($returnType->getName()) {
                case 'array':
                    /** @var Field $annotation */
                    $annotation = $this->annotationReader->getMethodAnnotation($this->reflectionMethod, Field::class);
                    if ($annotation) {
                        $returnTypeClassName = str_replace("[]", "", $annotation->type);
                        $returnTypeClassName = $this->entityNamespaceName . $returnTypeClassName;
                        if (class_exists($returnTypeClassName)) {
                            $type = $this->types->getOutput($returnTypeClassName);
                        }
                    }
                    $type = Type::listOf($type);
                    break;
            }
        }
        if (!$returnType->allowsNull()) {
            $type = Type::nonNull($type);
        }
        return $type;
    }
}
