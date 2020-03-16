<?php

declare(strict_types=1);

use GraphQL\Upload\UploadMiddleware;
use Mezzio\Application;
use Mezzio\Authentication;
use Mezzio\Authentication\OAuth2\TokenEndpointHandler;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;

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
