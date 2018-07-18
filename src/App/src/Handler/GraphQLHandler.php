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
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Diactoros\Response\JsonResponse;

class GraphQLHandler implements RequestHandlerInterface
{

    /** @var TypeRegistry $typeRegistry */
    protected $typeRegistry;

    public function __construct(AbstractAdapter $cacheStorageAdapter)
    {
        $this->typeRegistry = new TypeRegistry($cacheStorageAdapter);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $config = SchemaConfig::create()
            ->setQuery($this->typeRegistry->get('query'));
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