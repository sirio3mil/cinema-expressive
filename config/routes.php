<?php

declare(strict_types=1);

use GraphQL\Upload\UploadMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Authentication;
use Zend\Expressive\Authentication\OAuth2\TokenEndpointHandler;

/**
 * @param Application $app
 */
return function (Application $app): void {

    $app->post('/', [
        Authentication\AuthenticationMiddleware::class,
        UploadMiddleware::class,
        App\Handler\GraphQLHandler::class
    ]);

    $app->post('/oauth', [
        TokenEndpointHandler::class
    ]);
};
