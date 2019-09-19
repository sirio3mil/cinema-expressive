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
use App\Resolver\EditTapeUserHistoryDetailResolver;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\EditTvShowResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;
use App\Resolver\ListTapeUserResolver;
use App\Resolver\ListTvShowChapterUserResolver;
use App\Resolver\SearchResolver;
use App\Resolver\TapeResolver;
use App\Service\ResolverManager;
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
     * @return RequestHandlerInterface
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $debug = $config['debug'] ?? false;

        GraphQL::setDefaultFieldResolver(new DefaultFieldResolver());

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
                    'importImdbEpisodes' => $manager->get(ImportImdbEpisodesResolver::class)
                ],
                'name' => 'mutation'
            ]));

        $schema = new Schema($config);

        return new GraphQLHandler($schema, $debug);
    }
}
