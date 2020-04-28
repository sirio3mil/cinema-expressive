<?php

declare(strict_types=1);

use App\Handler\GraphQLHandler;
use App\Middleware\AuthenticationMiddleware;
use GraphQL\Upload\UploadMiddleware;
use Mezzio\Application;
use Mezzio\Helper\BodyParams\BodyParamsMiddleware;

/**
 * @param Application $app
 */
return function (Application $app): void {
    $app->post('/', [
        AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        UploadMiddleware::class,
        GraphQLHandler::class
    ]);
};
