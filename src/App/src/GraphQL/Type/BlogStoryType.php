<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:16
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class BlogStoryType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'author' => $types->get('user'),
                'title' => Type::string()
            ],
            'resolve' => function() {
                return [
                    'id' => 1,
                    'title' => 'Example blog post',
                    'authorId' => 1
                ];
            }
        ]);
    }
}