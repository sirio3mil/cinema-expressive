<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:51
 */

namespace App\Factory;

use App\Resolver\EditTapeUserHistoryDetailResolver;
use App\Resolver\EditTvShowResolver;
use App\Service\ResolverManager;
use App\Type\MutationType;
use Psr\Container\ContainerInterface;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;
use ReflectionException;

class MutationFactory
{

    /**
     * @param ContainerInterface $container
     * @return MutationType
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): MutationType
    {
        $manager = new ResolverManager($container);
        return new MutationType([
            'fields' => [
                'editTapeUser' => $container->get(EditTapeUserResolver::class),
                'editTapeUserHistoryDetail' => $container->get(EditTapeUserHistoryDetailResolver::class),
                'editTvShow' => $container->get(EditTvShowResolver::class),
                'importImdbMovie' => $manager->get(ImportImdbMovieResolver::class),
                'importImdbEpisodes' => $manager->get(ImportImdbEpisodesResolver::class)
            ]
        ]);
    }
}
