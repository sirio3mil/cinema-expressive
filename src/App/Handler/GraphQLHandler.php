<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/06/2018
 * Time: 14:52
 */

namespace App\Handler;

use GraphQL\Error\DebugFlag;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GraphQLHandler implements RequestHandlerInterface
{
    private ServerConfig $serverConfig;

    public function __construct(Schema $schema, bool $debug)
    {
        $this->serverConfig = ServerConfig::create()
            ->setSchema($schema)
            ->setQueryBatching(true);
        if ($debug) {
            $this->serverConfig->setDebugFlag(DebugFlag::INCLUDE_TRACE);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws InvalidArgumentException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->serverConfig->setContext($request->getAttribute(UserInterface::class));
        $response = (new StandardServer($this->serverConfig))->executePsrRequest($request);
        return new JsonResponse($response);
    }
}
