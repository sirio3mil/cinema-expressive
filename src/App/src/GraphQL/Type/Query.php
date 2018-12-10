<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;


use App\GraphQL\Resolver\EpisodeListResolver;
use App\GraphQL\Resolver\MovieCastResolver;
use App\GraphQL\Resolver\MovieCertificateResolver;
use App\GraphQL\Resolver\MovieKeywordResolver;
use App\GraphQL\Resolver\MovieLocationResolver;
use App\GraphQL\Resolver\MovieReleaseResolver;
use App\GraphQL\Resolver\SearchResolver;
use App\GraphQL\Resolver\MovieDetailResolver;
use GraphQL\Type\Definition\ObjectType;
use Psr\Container\ContainerInterface;


class Query extends ObjectType
{

    public function __construct(ContainerInterface $container)
    {

        parent::__construct([
            'fields' => [
                'search' => $container->get(SearchResolver::class),
                'imdbMovieDetails' => $container->get(MovieDetailResolver::class),
                'imdbMovieCredits' => $container->get(MovieCastResolver::class),
                'imdbMovieReleases' => $container->get(MovieReleaseResolver::class),
                'imdbMovieKeywords' => $container->get(MovieKeywordResolver::class),
                'imdbMovieLocations' => $container->get(MovieLocationResolver::class),
                'imdbMovieCertifications' => $container->get(MovieCertificateResolver::class),
                'imdbEpisodeList' => $container->get(EpisodeListResolver::class)
            ]
        ]);
    }
}