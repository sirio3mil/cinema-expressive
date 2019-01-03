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
use Zend\ProblemDetails\ProblemDetailsResponseFactory;
use Zend\Stratigility\Middleware\CallableMiddlewareWrapper;

class CorsMiddlewareFactory
{
    /** @var ProblemDetailsResponseFactory */
    protected static $problemDetailsResponseFactory;

    /**
     * @param ContainerInterface $container
     * @return CallableMiddlewareWrapper
     */
    public function __invoke(ContainerInterface $container): CallableMiddlewareWrapper
    {
        self::$problemDetailsResponseFactory = $container->get(ProblemDetailsResponseFactory::class);
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
     * @return ResponseInterface
     */
    public static function error(RequestInterface $request, ResponseInterface $response, $arguments): ResponseInterface
    {
        return self::$problemDetailsResponseFactory->createResponse(
            $request,
            401,
            '',
            $arguments['message'],
            '',
            []
        );
    }
}