<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Authentication\OAuth2;
use Zend\Expressive\Session\SessionMiddleware;

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
    $app->post('/oauth2/token', OAuth2\TokenEndpointHandler::class);
    $app->post('/api/users', [
        Zend\Expressive\Authentication\AuthenticationMiddleware::class,
        App\Action\AddUserAction::class,
    ], 'api.add.user');
    $app->route('/oauth2/authorize', [
        SessionMiddleware::class,

        OAuth2\AuthorizationMiddleware::class,

        // The following middleware is provided by your application (see below):
        App\OAuthAuthorizationMiddleware::class,

        OAuth2\AuthorizationHandler::class
    ], ['GET', 'POST']);
};
