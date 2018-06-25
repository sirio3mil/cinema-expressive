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
    private $types = [];

    public function get($name)
    {
        if (!isset($this->types[$name])) {
            $this->types[$name] = $this->{$name}();
        }
        return $this->types[$name];
    }

    public function test()
    {
        return new TestType($this);
    }
}