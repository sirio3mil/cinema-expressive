<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 03/01/2019
 * Time: 14:53
 */

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tuupola\Middleware\CorsMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Stratigility\Middleware\CallableMiddlewareWrapper;

class CorsMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CallableMiddlewareWrapper
    {
        return new CallableMiddlewareWrapper(
            new CorsMiddleware([
                "origin" => ["*"],
                "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
                "headers.allow" => ["Content-Type", "Accept"],
                "headers.expose" => [],
                "credentials" => false,
                "cache" => 0,
                "error" => [$this, 'error'],
            ]),
            new Response()
        );
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $arguments
     * @return JsonResponse
     */
    public static function error(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments
    ) {

        return new JsonResponse($arguments);
    }
}