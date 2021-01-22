<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 05/09/2018
 * Time: 17:24
 */

namespace App\Resolver;

use App\Entity\TvShowChapter;
use App\Service\ImportImdbMovieService;
use Ausi\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use GraphQL\Doctrine\Annotation as API;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Model\Episode;

class ImportImdbEpisodesResolver extends AbstractResolver implements MutationResolverInterface
{
    /**
     * ImportImdbMovieResolver constructor.
     * @param EntityManager $entityManager
     * @param SlugGenerator $slugGenerator
     * @param EpisodeListMapper $episodeListMapper
     */
    public function __construct(
        private EntityManager $entityManager,
        private SlugGenerator $slugGenerator,
        private EpisodeListMapper $episodeListMapper
    )
    {
    }

    /**
     * @API\Field(type="TvShowChapter[]")
     *
     * @param int $imdbNumber
     * @param int $seasonNumber
     * @return TvShowChapter[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    protected function execute(int $imdbNumber, int $seasonNumber): array
    {
        $episodes = [];

        $this->episodeListMapper
            ->setSeason($seasonNumber)
            ->setImdbNumber($imdbNumber)
            ->setContentFromUrl();
        $episodeIterator = $this->episodeListMapper->getEpisodes();
        $importImdbMovieService = new ImportImdbMovieService($this->entityManager, $this->slugGenerator);
        /** @var Episode $episode */
        foreach ($episodeIterator as $episode) {
            $importImdbMovieService->setImdbNumber($episode->getImdbNumber());
            $importImdbMovieService->import();
            $tape = $importImdbMovieService->getTape();
            $this->entityManager->persist($tape);
            $episodes[] = $tape->getTvShowChapter();
        }
        $this->entityManager->flush();

        return $episodes;
    }

    /**
     * @param array $args
     * @return TvShowChapter[]
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function resolve(array $args): array
    {
        return $this->execute($args['imdbNumber'], $args['seasonNumber']);
    }
}
