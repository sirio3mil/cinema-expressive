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
            'storage' => $this->cacheStorageAdapter
        ]);
        return $cache->getData($args);
    }

    public function getGraphQLType()
    {
        return [
            'type' => $this->type,
            'args' => $this->args,
            'resolve' => function ($source, $args) {
                return $this->getData($args);
            }
        ];
    }
}