<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;

class Query extends ObjectType
{

    public function __construct(array $fields)
    {

        parent::__construct($fields);
    }
}