<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/06/2018
 * Time: 14:52
 */

namespace App\Handler;

use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Authentication\UserInterface;

class GraphQLHandler implements RequestHandlerInterface
{

    /** @var ServerConfig */
    private $serverConfig;

    public function __construct(Schema $schema, bool $debug)
    {
        $this->serverConfig = ServerConfig::create()
            ->setSchema($schema)
            ->setQueryBatching(true)
            ->setDebug($debug);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->serverConfig->setContext($request->getAttribute(UserInterface::class));
        $response = (new StandardServer($this->serverConfig))->executePsrRequest($request);
        return new JsonResponse($response);
    }
}
