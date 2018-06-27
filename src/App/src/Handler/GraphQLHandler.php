<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/06/2018
 * Time: 14:52
 */

namespace App\Handler;

use App\GraphQL\TypeRegistry;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class GraphQLHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $userType = new ObjectType([
            'name' => 'User',
            'fields' => [

                'id' => [
                    'type' => Type::int()
                ],

                'name' => [
                    'type' => Type::string()
                ]

            ]
        ]);
        $blogStoryType = new ObjectType([
            'name' => 'BlogStory',
            'fields' => [

                'author' => [
                    'type' => $userType,
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
        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [

                'lastStory' => [
                    'type' => $blogStoryType,
                    'resolve' => function() {
                        return [
                            'id' => 1,
                            'title' => 'Example blog post',
                            'authorId' => 1
                        ];
                    }
                ]

            ]
        ]);
        $config = SchemaConfig::create()
            ->setQuery($queryType);
        $schema = new Schema($config);
        $server = new StandardServer([
            'schema' => $schema,
            'queryBatching' => true,
            'debug' => true
        ]);
        $response = $server->executePsrRequest($request);
        return new JsonResponse($response);
    }
}