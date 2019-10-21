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
use App\Resolver\CreateFileResolver;
use App\Resolver\EditTapeUserHistoryDetailResolver;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\EditTvShowResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;
use App\Resolver\ListTapeUserResolver;
use App\Resolver\ListTvShowChapterUserResolver;
use App\Resolver\SearchResolver;
use App\Resolver\TapeResolver;
use App\Resolver\ResolverManager;
use GraphQL\Doctrine\DefaultFieldResolver;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionException;

class GraphQLHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return SchemaConfig
     * @throws ReflectionException
     */
    protected static function getSchemaConfig(ContainerInterface $container): SchemaConfig
    {
        $manager = new ResolverManager($container);

        $config = SchemaConfig::create()
            ->setQuery(new ObjectType([
                'fields' => [
                    'search' => $manager->get(SearchResolver::class),
                    'tape' => $manager->get(TapeResolver::class),
                    'listTapeUser' => $manager->get(ListTapeUserResolver::class),
                    'listTvShowChapterUser' => $manager->get(ListTvShowChapterUserResolver::class)
                ],
                'name' => 'query'
            ]))
            ->setMutation(new ObjectType([
                'fields' => [
                    'editTapeUser' => $manager->get(EditTapeUserResolver::class),
                    'editTapeUserHistoryDetail' => $manager->get(EditTapeUserHistoryDetailResolver::class),
                    'editTvShow' => $manager->get(EditTvShowResolver::class),
                    'importImdbMovie' => $manager->get(ImportImdbMovieResolver::class),
                    'importImdbEpisodes' => $manager->get(ImportImdbEpisodesResolver::class),
                    'createFile' => $manager->get(CreateFileResolver::class)
                ],
                'name' => 'mutation'
            ]));
        return $config;
    }

    /**
     * @param ContainerInterface $container
     * @return Schema
     * @throws ReflectionException
     */
    protected static function getSchema(ContainerInterface $container): Schema
    {
        $config = self::getSchemaConfig($container);

        $schema = new Schema($config);
        return $schema;
    }

    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $debug = $config['debug'] ?? false;

        GraphQL::setDefaultFieldResolver(new DefaultFieldResolver());

        $schema = self::getSchema($container);

        return new GraphQLHandler($schema, $debug);
    }
}
