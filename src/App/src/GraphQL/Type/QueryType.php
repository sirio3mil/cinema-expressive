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
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use App\GraphQL\Wrapper\MovieDetailsWrapper;
use App\GraphQL\Wrapper\EpisodeListWrapper;
use App\GraphQL\Wrapper\MovieCreditsWrapper;
use App\GraphQL\Wrapper\MovieReleasesWrapper;
use App\GraphQL\Wrapper\MovieKeywordsWrapper;
use App\GraphQL\Wrapper\MovieLocationsWrapper;
use App\GraphQL\Wrapper\MovieCertificatesWrapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;

class QueryType extends ObjectType
{

    public function __construct(TypeRegistry $typeRegistry)
    {

        /** @var AbstractAdapter $cacheStorageAdapter */
        $cacheStorageAdapter = $typeRegistry->getCacheStorageAdapter();

        parent::__construct([
            'fields' => [
                'search' => [
                    'type' => Type::listOf(Type::string()),
                    'args' => [
                        'pattern' => Type::nonNull(Type::string())
                    ],
                    'resolve' => function ($source, $args) use ($typeRegistry) {
                        $adapter = $typeRegistry->getContainer()->get(AdapterInterface::class);

                        $sql = "SELECT FT_TBL.searchParam  
                                FROM dbo.SearchValue AS FT_TBL   
                                    INNER JOIN FREETEXTTABLE(dbo.SearchValue,  
                                        searchParam,   
                                        ?) AS KEY_TBL  
                                    ON FT_TBL.searchValueId = KEY_TBL.[KEY]  
                                ORDER BY RANK DESC";
                        /** @var ResultSet $stmt */
                        $stmt = $adapter->query($sql, [
                            $args['pattern']
                        ]);

                        $results = [];

                        foreach ($stmt as $row) {
                            $results[] = $row->searchParam;
                        }

                        return $results;
                    }
                ],
                'imdbMovieDetails' => [
                    'type'    => $typeRegistry->get('movie'),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieDetailsWrapper(), $args);
                    }
                ],
                'imdbMovieCredits' => [
                    'type' => $typeRegistry->get('credits'),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieCreditsWrapper(), $args);
                    }
                ],
                'imdbMovieReleases' => [
                    'type' => $typeRegistry->get('release'),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieReleasesWrapper(), $args);
                    }
                ],
                'imdbMovieKeywords' => [
                    'type' => $typeRegistry->get('keywords'),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieKeywordsWrapper(), $args);
                    }
                ],
                'imdbMovieLocations' => [
                    'type' => Type::listOf($typeRegistry->get('location')),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieLocationsWrapper(), $args);
                    }
                ],
                'imdbMovieCertifications' => [
                    'type' => Type::listOf($typeRegistry->get('certification')),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new MovieCertificatesWrapper(), $args);
                    }
                ],
                'imdbEpisodeList' => [
                    'type'    => Type::listOf($typeRegistry->get('episode')),
                    'args'    => [
                        'imdbNumber' => Type::nonNull(Type::int()),
                        'seasonNumber' => Type::int()
                    ],
                    'resolve' => function ($source, $args) use ($cacheStorageAdapter) {
                        return CachedQueryResolver::resolve($cacheStorageAdapter, new EpisodeListWrapper(), $args);
                    }
                ]
            ]
        ]);
    }
}