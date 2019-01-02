<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/06/2018
 * Time: 14:52
 */

namespace App\Handler;

use GraphQL\Server\StandardServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class GraphQLHandler implements RequestHandlerInterface
{

    /** @var StandardServer $standardServer */
    protected $standardServer;

    public function __construct(StandardServer $standardServer)
    {
        $this->standardServer = $standardServer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->standardServer->executePsrRequest($request);
        return new JsonResponse($response);
    }
}