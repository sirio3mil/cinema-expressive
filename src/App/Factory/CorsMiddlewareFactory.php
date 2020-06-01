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
use Mezzio\ProblemDetails\ProblemDetailsResponseFactory;

class CorsMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return CorsMiddleware
     */
    public function __invoke(ContainerInterface $container): CorsMiddleware
    {
        return new CorsMiddleware([
            "origin" => ["https://cinema.lcl:4443"],
            "methods" => ["POST"],
            "headers.allow" => ["authorization"],
            "headers.expose" => [],
            "credentials" => false,
            "cache" => 8600,
            "error" => function (RequestInterface $request, ResponseInterface $response, $arguments) use ($container) {
                return $container->get(ProblemDetailsResponseFactory::class)->createResponse(
                    $request,
                    401,
                    '',
                    $arguments['message'],
                    '',
                    []
                );
            }
        ]);
    }
}
