<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 17:24
 */

declare(strict_types=1);

namespace App\Factory;

use App\Handler\GraphQLHandler;
use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GraphQLHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $schema = $container->get(Schema::class);
        $config = $container->has('config') ? $container->get('config') : [];

        return new GraphQLHandler($schema, $config['debug']);
    }
}
