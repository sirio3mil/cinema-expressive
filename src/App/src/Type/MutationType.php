<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:36
 */

namespace App\Type;

use GraphQL\Type\Definition\ObjectType;

class MutationType extends ObjectType
{

    public function __construct(array $config)
    {

        parent::__construct($config);
    }
}