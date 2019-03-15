<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\GraphQL\Resolver;

use App\Entity\Tape;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ImportImdbEpisodeListResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $episodeList
     * @return TvShowChapter[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected static function importEpisodes(ContainerInterface $container, array $episodeList): array
    {
        $episodes = [];

        foreach ($episodeList as $episode) {
            /** @var Tape $tape */
            $tape = ImportImdbMovieResolver::resolve($container, $episode);
            $episodes[] = $tape->getTvShowChapter();
        }

        return $episodes;
    }

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return TvShowChapter[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        $episodes = [];
        /** @var array $imdbEpisodeList */
        $imdbEpisodeList = ImdbEpisodeListResolver::resolve($container, $args);
        if ($imdbEpisodeList) {
            $episodes = self::importEpisodes($container, $imdbEpisodeList);
        }
        return $episodes;
    }
}