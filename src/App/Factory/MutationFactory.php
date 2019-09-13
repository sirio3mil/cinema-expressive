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
use App\Type\MutationType;
use Psr\Container\ContainerInterface;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;

class MutationFactory
{
    public function __invoke(ContainerInterface $container): MutationType
    {
        return new MutationType([
            'fields' => [
                'editTapeUser' => $container->get(EditTapeUserResolver::class),
                'editTapeUserHistoryDetail' => $container->get(EditTapeUserHistoryDetailResolver::class),
                'editTvShow' => $container->get(EditTvShowResolver::class),
                'importImdbMovie' => $container->get(ImportImdbMovieResolver::class),
                'importImdbEpisodeList' => $container->get(ImportImdbEpisodesResolver::class)
            ]
        ]);
    }
}
