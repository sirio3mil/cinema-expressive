<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 14:51
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;

class MovieType extends ObjectType
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
}