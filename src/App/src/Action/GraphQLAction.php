<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 15:29
 */

declare(strict_types=1);

namespace App\Action;

use App\GraphQL\TypeRegistry;
use GraphQL\Type\Schema;
use GraphQL\Server\StandardServer;
use GraphQL\Type\SchemaConfig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class GraphQLAction implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
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