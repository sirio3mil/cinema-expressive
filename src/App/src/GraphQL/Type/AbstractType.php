<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:35
 */

namespace App\GraphQL\Type;


use App\GraphQL\Wrapper\AbstractWrapper;
use GraphQL\Type\Definition\ObjectType;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

abstract class AbstractType extends ObjectType
{
    /** @var TypeRegistry $typeRegistry */
    protected $typeRegistry;
    /** @var AbstractAdapter $cacheStorageAdapter */
    protected $cacheStorageAdapter;
    /** @var AbstractWrapper $wrapper */
    protected $wrapper;

    /**
     * @return AbstractWrapper
     */
    public function getWrapper(): AbstractWrapper
    {
        return $this->wrapper;
    }

    /**
     * @return AbstractAdapter
     */
    public function getCacheStorageAdapter(): AbstractAdapter
    {
        return $this->cacheStorageAdapter;
    }

    /**
     * @return TypeRegistry
     */
    public function getTypeRegistry(): TypeRegistry
    {
        return $this->typeRegistry;
    }
}