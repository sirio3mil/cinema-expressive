<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:58
 */

namespace App\Factory;

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;

class StandardServerFactory
{
    public function __invoke(ContainerInterface $container): StandardServer
    {
        $schema = $container->get(Schema::class);
        $config = $container->has('config') ? $container->get('config') : [];
        return new StandardServer([
            'schema' => $schema,
            'queryBatching' => true,
            'debug' => $config['debug']
        ]);
    }
}