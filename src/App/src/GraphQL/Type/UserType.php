<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:19
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'name' => Type::string(),
                'id' => Type::int()
            ],
            'resolve' => function(BlogStoryType $blogStory) {
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
        ]);
    }
}