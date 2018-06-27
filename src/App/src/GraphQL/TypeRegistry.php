<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:39
 */

namespace App\GraphQL;

use App\GraphQL\Type\TestType;

class TypeRegistry
{
    public function get(string $name)
    {
        $className = '\\App\\GraphQL\\Type\\' . ucfirst($name) . 'Type';
        return new $className($this);
    }
}