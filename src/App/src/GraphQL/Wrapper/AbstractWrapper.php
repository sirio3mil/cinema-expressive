<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:37
 */

namespace App\GraphQL\Wrapper;

use GraphQL\Type\Definition\ObjectType;
use Zend\Cache\Pattern\ObjectCache;
use Zend\Cache\PatternFactory;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

abstract class AbstractWrapper
{

    /** @var AbstractAdapter $cacheStorageAdapter */
    protected $cacheStorageAdapter;

    /** @var ObjectType */
    protected $type;

    /** @var array */
    protected $args;

    /**
     * @param AbstractAdapter $cacheStorageAdapter
     * @return AbstractWrapper
     */
    public function setCacheStorageAdapter(AbstractAdapter $cacheStorageAdapter): AbstractWrapper
    {
        $this->cacheStorageAdapter = $cacheStorageAdapter;
        return $this;
    }

    /**
     * @param ObjectType $type
     * @return AbstractWrapper
     */
    public function setType(ObjectType $type): AbstractWrapper
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return ObjectType
     */
    public function getType(): ObjectType
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @return AbstractAdapter
     */
    public function getCacheStorageAdapter(): AbstractAdapter
    {
        return $this->cacheStorageAdapter;
    }

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public abstract function getData(array $args): array;

    public function getDataInCache(array $args)
    {

        /** @var ObjectCache $cache */
        $cache = PatternFactory::factory('object', [
            'object' => $this,
            'storage' => $this->getCacheStorageAdapter()
        ]);
        return $cache->getData($args);
    }

    public function getGraphQLType()
    {
        return [
            'type' => $this->getType(),
            'args' => $this->getArgs(),
            'resolve' => function ($source, $args) {
                return $this->getDataInCache($args);
            }
        ];
    }
}