<?php

declare(strict_types=1);

use GraphQL\Upload\UploadMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Authentication;
use Zend\Expressive\Authentication\OAuth2\TokenEndpointHandler;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;

/**
 * @param Application $app
 */
return function (Application $app): void {

    $app->post('/', [
        Authentication\AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        UploadMiddleware::class,
        App\Handler\GraphQLHandler::class
    ]);

    $app->post('/oauth', [
        TokenEndpointHandler::class
    ]);
};
