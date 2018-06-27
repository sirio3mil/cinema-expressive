<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'lastStory' => [
                    'type' => $types->get('blogStory'),
                    'resolve' => function () {
                        return [
                            'id' => 1,
                            'title' => 'Example blog post',
                            'authorId' => 1
                        ];
                    }
                ]
            ]
        ]);
    }
}