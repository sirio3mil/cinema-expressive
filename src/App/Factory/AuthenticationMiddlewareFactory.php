<?php

declare(strict_types=1);

namespace App\Factory;

use App\Middleware\AuthenticationMiddleware;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\Exception\InvalidConfigException;
use Psr\Container\ContainerInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        $authentication = $container->has(AuthenticationInterface::class)
            ? $container->get(AuthenticationInterface::class)
            : null;
        if (null === $authentication) {
            throw new InvalidConfigException(
                'AuthenticationInterface service is missing'
            );
        }
        return new AuthenticationMiddleware($authentication);
    }
}
