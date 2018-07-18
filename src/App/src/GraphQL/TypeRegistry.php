<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:39
 */

namespace App\GraphQL;

use GraphQL\Type\Definition\ObjectType;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

class TypeRegistry
{

    /** @var AbstractAdapter $cacheStorageAdapter */
    protected $cacheStorageAdapter;

    public function __construct(AbstractAdapter $cacheStorageAdapter)
    {
        $this->cacheStorageAdapter = $cacheStorageAdapter;
    }

    public function get(string $name): ObjectType
    {
        $className = self::getClassName($name);
        return new $className($this, $this->cacheStorageAdapter);
    }

    protected static function getClassName(string $name): string
    {
        return __NAMESPACE__ . '\\Type\\' . ucfirst($name) . 'Type';
    }
}