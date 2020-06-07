<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 03/01/2019
 * Time: 14:53
 */

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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
            "origin" => "*",
            "methods" => ["POST"],
            "headers.allow" => ["authorization", "content-type"],
            "headers.expose" => [],
            "credentials" => true,
            "cache" => 1728000,
            "error" => function (ServerRequestInterface $request, ResponseInterface $response, $arguments) use ($container) {
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
