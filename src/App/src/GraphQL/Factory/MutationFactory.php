<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:51
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\EditTapeDetailResolver;
use App\GraphQL\Type\MutationType;
use Psr\Container\ContainerInterface;
use App\GraphQL\Resolver\EditTapeUserResolver;
use App\GraphQL\Resolver\ImportImdbEpisodesResolver;
use App\GraphQL\Resolver\ImportImdbMovieResolver;

class MutationFactory
{
    public function __invoke(ContainerInterface $container): MutationType
    {
        return new MutationType([
            'fields' => [
                'editTapeUser' => $container->get(EditTapeUserResolver::class),
                'editTapeDetail' => $container->get(EditTapeDetailResolver::class),
                'importImdbMovie' => $container->get(ImportImdbMovieResolver::class),
                'importImdbEpisodeList' => $container->get(ImportImdbEpisodesResolver::class)
            ]
        ]);
    }
}