<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Authentication;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Authentication\OAuth2\TokenEndpointHandler;

/**
 * Setup routes with a single request method:
 *
 * @param Application $app
 * @param MiddlewareFactory $factory
 * @param ContainerInterface $container
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->post('/graphql', App\Handler\GraphQLHandler::class, 'graphql');
    // OAuth2 token route
    $app->post('/oauth', TokenEndpointHandler::class, 'oauth-token');
    // API
    $app->get('/api/users[/{id}]', App\User\UserHandler::class, 'api.users');
    $app->post('/api/users', [
        Authentication\AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        App\User\CreateUserHandler::class
    ]);
    $app->route('/api/users/{id}', [
        Authentication\AuthenticationMiddleware::class,
        BodyParamsMiddleware::class,
        App\User\ModifyUserHandler::class
    ], ['PATCH', 'DELETE'], 'api.user');
};
