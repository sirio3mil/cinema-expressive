<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:43
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Type\Query;
use Psr\Container\ContainerInterface;
use App\GraphQL\Resolver\EpisodeListResolver;
use App\GraphQL\Resolver\MovieCastResolver;
use App\GraphQL\Resolver\MovieCertificateResolver;
use App\GraphQL\Resolver\MovieKeywordResolver;
use App\GraphQL\Resolver\MovieLocationResolver;
use App\GraphQL\Resolver\MovieReleaseResolver;
use App\GraphQL\Resolver\SearchResolver;
use App\GraphQL\Resolver\MovieDetailResolver;

class QueryFactory
{
    public function __invoke(ContainerInterface $container): Query
    {
        return new Query([
            'fields' => [
                'search' => $container->get(SearchResolver::class)
            ]
        ]);
    }
}