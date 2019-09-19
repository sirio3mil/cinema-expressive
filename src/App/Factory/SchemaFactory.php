<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 10:48
 */

namespace App\Factory;

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
use ReflectionException;

class SchemaFactory
{
    /**
     * @param ContainerInterface $container
     * @return Schema
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): Schema
    {
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

        return new Schema($config);
    }
}
