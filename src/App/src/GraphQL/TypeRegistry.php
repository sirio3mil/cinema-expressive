<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:39
 */

namespace App\GraphQL;

use App\GraphQL\Type\BlogStoryType;
use App\GraphQL\Type\QueryType;
use App\GraphQL\Type\TestType;
use App\GraphQL\Type\UserType;

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

    public function query()
    {
        return new QueryType($this);
    }

    public function blogStory()
    {
        return new BlogStoryType($this);
    }

    public function user()
    {
        return new UserType($this);
    }
}