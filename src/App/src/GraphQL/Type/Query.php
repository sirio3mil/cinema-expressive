<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use App\GraphQL\Wrapper\AbstractWrapper;
use App\GraphQL\Wrapper\SearchWrapper;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Wrapper\MovieDetailsWrapper;
use App\GraphQL\Wrapper\EpisodeListWrapper;
use App\GraphQL\Wrapper\MovieCreditsWrapper;
use App\GraphQL\Wrapper\MovieReleasesWrapper;
use App\GraphQL\Wrapper\MovieKeywordsWrapper;
use App\GraphQL\Wrapper\MovieLocationsWrapper;
use App\GraphQL\Wrapper\MovieCertificatesWrapper;
use Psr\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\Adapter\Memcached;


class Query extends ObjectType
{

    public function __construct(ContainerInterface $container)
    {

        parent::__construct([
            'fields' => [
                'search' => $container->get(SearchWrapper::class)->getGraphQLType(),
                'imdbMovieDetails' => $container->get(MovieDetailsWrapper::class)->getGraphQLType(),
                'imdbMovieCredits' => $container->get(MovieCreditsWrapper::class)->getGraphQLType(),
                'imdbMovieReleases' => $container->get(MovieReleasesWrapper::class)->getGraphQLType(),
                'imdbMovieKeywords' => $container->get(MovieKeywordsWrapper::class)->getGraphQLType(),
                'imdbMovieLocations' => $container->get(MovieLocationsWrapper::class)->getGraphQLType(),
                'imdbMovieCertifications' => $container->get(MovieCertificatesWrapper::class)->getGraphQLType(),
                'imdbEpisodeList' => $container->get(EpisodeListWrapper::class)->getGraphQLType()
            ]
        ]);
    }
}