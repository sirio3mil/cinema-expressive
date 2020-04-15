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
use App\Resolver\EditSeasonUserResolver;
use App\Resolver\EditTapeUserHistoryDetailResolver;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\EditTvShowResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;
use App\Resolver\ListPlaceResolver;
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
     * @param ResolverManager $manager
     * @return ObjectType
     * @throws ReflectionException
     */
    protected static function getQueryType(ResolverManager $manager): ObjectType
    {
        return new ObjectType([
            'fields' => [
                'search' => $manager->get(SearchResolver::class),
                'tape' => $manager->get(TapeResolver::class),
                'listTapeUser' => $manager->get(ListTapeUserResolver::class),
                'listTvShowChapterUser' => $manager->get(ListTvShowChapterUserResolver::class),
                'listPlace' => $manager->get(ListPlaceResolver::class)
            ],
            'name' => 'query'
        ]);
    }

    /**
     * @param ResolverManager $manager
     * @return ObjectType
     * @throws ReflectionException
     */
    protected static function getMutationType(ResolverManager $manager): ObjectType
    {
        return new ObjectType([
            'fields' => [
                'editTapeUser' => $manager->get(EditTapeUserResolver::class),
                'editSeasonUser' => $manager->get(EditSeasonUserResolver::class),
                'editTapeUserHistoryDetail' => $manager->get(EditTapeUserHistoryDetailResolver::class),
                'editTvShow' => $manager->get(EditTvShowResolver::class),
                'importImdbMovie' => $manager->get(ImportImdbMovieResolver::class),
                'importImdbEpisodes' => $manager->get(ImportImdbEpisodesResolver::class),
                'createFile' => $manager->get(CreateFileResolver::class)
            ],
            'name' => 'mutation'
        ]);
    }

    /**
     * @param ContainerInterface $container
     * @return SchemaConfig
     * @throws ReflectionException
     */
    protected static function getSchemaConfig(ContainerInterface $container): SchemaConfig
    {
        $manager = new ResolverManager($container);

        return SchemaConfig::create()
            ->setQuery(self::getQueryType($manager))
            ->setMutation(self::getMutationType($manager));
    }

    /**
     * @param ContainerInterface $container
     * @return Schema
     * @throws ReflectionException
     */
    protected static function getSchema(ContainerInterface $container): Schema
    {
        $config = self::getSchemaConfig($container);

        return new Schema($config);
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
