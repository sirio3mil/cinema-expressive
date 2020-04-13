<?php

namespace App\Factory;

use App\Middleware\OauthMiddleware;
use Psr\Container\ContainerInterface;

class OauthMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): OauthMiddleware
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = $config['oauth'] ?? [];
        return new OauthMiddleware($config);
    }
}
