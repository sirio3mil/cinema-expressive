<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace App\Middleware;

use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function str_starts_with;

class AuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(protected AuthenticationInterface $auth)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->auth->authenticate($request);
        if (null !== $user) {
            return $handler->handle($request->withAttribute(UserInterface::class, $user));
        }
        $query = $request->getParsedBody()['query'] ?? null;
        if ($query && str_starts_with($query, 'query login')) {
            return $handler->handle($request);
        }

        return $this->auth->unauthorizedResponse($request);
    }
}
