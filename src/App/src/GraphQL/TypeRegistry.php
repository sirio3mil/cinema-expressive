<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:39
 */

namespace App\GraphQL;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\Adapter\Memcached;

class TypeRegistry
{

    /** @var ContainerInterface $container */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return AbstractAdapter
     */
    public function getCacheStorageAdapter(): AbstractAdapter
    {
        return $this->container->get(Memcached::class);
    }

    public function getSchema(): Schema
    {
        return $this->container->get(Schema::class);
    }

    public function get(string $name): ObjectType
    {
        $className = self::getClassName($name);
        return new $className($this);
    }

    protected static function getClassName(string $name): string
    {
        return __NAMESPACE__ . '\\Type\\' . ucfirst($name) . 'Type';
    }
}