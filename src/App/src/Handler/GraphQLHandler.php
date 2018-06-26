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

class GraphQLHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $registry = new TypeRegistry();
        $config = SchemaConfig::create()
            ->setQuery($registry->get('Query'))
            ->setTypeLoader(function($name) use ($registry) {
                return $registry->get($name);
            });
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