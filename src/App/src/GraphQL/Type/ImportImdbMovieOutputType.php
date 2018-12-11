<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 11/12/2018
 * Time: 15:35
 */

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ImportImdbMovieOutputType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'tapeId' => Type::int()
            ]
        ]);
    }
}