<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:35
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

abstract class AbstractType extends ObjectType
{

    /** @var AbstractAdapter $cacheStorageAdapter */
    protected $cacheStorageAdapter;

    /**
     * @return AbstractAdapter
     */
    public function getCacheStorageAdapter(): AbstractAdapter
    {
        return $this->cacheStorageAdapter;
    }
}