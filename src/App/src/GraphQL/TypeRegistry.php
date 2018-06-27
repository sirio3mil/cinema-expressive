<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:39
 */

namespace App\GraphQL;

use GraphQL\Type\Definition\ObjectType;

class TypeRegistry
{
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