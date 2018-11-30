<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;


use App\GraphQL\Resolver\CachedQueryResolver;
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


class QueryType extends ObjectType
{

    /** @var TypeRegistry */
    protected $typeRegistry;

    public function __construct(TypeRegistry $typeRegistry)
    {

        $this->typeRegistry = $typeRegistry;

        parent::__construct([
            'fields' => [
                'search' => [
                    'type' => Type::listOf($typeRegistry->get('searchResult')),
                    'args' => [
                        'pattern' => Type::nonNull(Type::string())
                    ],
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        $wrapper = new SearchWrapper($typeRegistry->getContainer());
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieDetails' => [
                    'type' => $typeRegistry->get('movie'),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieDetailsWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieCredits' => [
                    'type' => $typeRegistry->get('credits'),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieCreditsWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieReleases' => [
                    'type' => $typeRegistry->get('release'),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieReleasesWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieKeywords' => [
                    'type' => $typeRegistry->get('keywords'),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieKeywordsWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieLocations' => [
                    'type' => Type::listOf($typeRegistry->get('location')),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieLocationsWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbMovieCertifications' => [
                    'type' => Type::listOf($typeRegistry->get('certification')),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new MovieCertificatesWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ],
                'imdbEpisodeList' => [
                    'type' => Type::listOf($typeRegistry->get('episode')),
                    'args' => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                        'seasonNumber' => Type::int()
                    ],
                    'resolve' => function ($source, $args) {
                        $wrapper = new EpisodeListWrapper();
                        return $this->getResults($wrapper, $args);
                    }
                ]
            ]
        ]);
    }

    protected function getResults(AbstractWrapper $wrapper, array $args): array
    {
        return CachedQueryResolver::resolve($this->typeRegistry->getCacheStorageAdapter(), $wrapper, $args);
    }
}