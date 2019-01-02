<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:51
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\BulkImageInsertionResolver;
use App\GraphQL\Type\Mutation;
use Psr\Container\ContainerInterface;
use App\GraphQL\Resolver\EditTapeUserResolver;
use App\GraphQL\Resolver\ImportImdbEpisodeListResolver;
use App\GraphQL\Resolver\ImportImdbMovieResolver;

class MutationFactory
{
    public function __invoke(ContainerInterface $container): Mutation
    {
        return new Mutation([
            'fields' => [
                'editTapeUser' => $container->get(EditTapeUserResolver::class),
                'importImdbMovie' => $container->get(ImportImdbMovieResolver::class),
                'importImdbEpisodeList' => $container->get(ImportImdbEpisodeListResolver::class),
                'bulkImageInsertion' => $container->get(BulkImageInsertionResolver::class)
            ]
        ]);
    }
}