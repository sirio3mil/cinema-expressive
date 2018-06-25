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
                'author' => [
                    'type' => $types->get('user'),
                    'resolve' => function($blogStory) {
                        $users = [
                            1 => [
                                'id' => 1,
                                'name' => 'Smith'
                            ],
                            2 => [
                                'id' => 2,
                                'name' => 'Anderson'
                            ]
                        ];
                        return $users[$blogStory['authorId']];
                    }
                ],
                'title' => [
                    'type' => Type::string()
                ]

            ]
        ]);
    }
}