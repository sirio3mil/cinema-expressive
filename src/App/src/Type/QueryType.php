<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\Type;


use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{

    public function __construct(array $config)
    {

        parent::__construct($config);
    }
}