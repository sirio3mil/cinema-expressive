<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\Resolver;

use App\Entity\Tape;
use App\Entity\TvShowChapter;
use ImdbScraper\Iterator\EpisodeIterator;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Model\Episode;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;

class ImportImdbEpisodesResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return TvShowChapter[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        $episodes = [];
        /** @var EpisodeListMapper $mapper */
        $mapper = $container->get(EpisodeListMapper::class);
        $mapper
            ->setSeason($args['seasonNumber'])
            ->setImdbNumber($args['imdbNumber'])
            ->setContentFromUrl();
        /** @var EpisodeIterator $episodeIterator */
        $episodeIterator = $mapper->getEpisodes();
        /** @var Episode $episode */
        foreach ($episodeIterator as $episode) {
            /** @var Tape $tape */
            $tape = ImportImdbMovieResolver::resolve($container, [
                'imdbNumber' => $episode->getImdbNumber()
            ]);
            $episodes[] = $tape->getTvShowChapter();
        }
        return $episodes;
    }
}
