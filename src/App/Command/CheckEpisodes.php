<?php

namespace App\Command;

use App\Entity\Premiere;
use App\Entity\Tape;
use App\Entity\TapeUser;
use App\Entity\TvShow;
use App\Entity\TvShowChapter;
use App\Entity\User;
use App\Service\ImportImdbMovieService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use ImdbScraper\Mapper\EpisodeListMapper;
use ImdbScraper\Model\Episode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function sprintf;

class CheckEpisodes extends Command
{
    private EntityManager $em;
    private ImportImdbMovieService $movieService;
    private EpisodeListMapper $episodeListMapper;

    public function __construct(
        EntityManager $entityManager,
        ImportImdbMovieService $movieService,
        EpisodeListMapper $episodeListMapper
    )
    {
        parent::__construct();
        $this->em = $entityManager;
        $this->movieService = $movieService;
        $this->episodeListMapper = $episodeListMapper;
    }

    protected function configure()
    {
        $this
            ->addArgument('current', InputArgument::OPTIONAL, 'Current season', 0);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $startScript = new DateTimeImmutable();
        try {
            $currentSeason = (bool)$input->getArgument('current');
            $userRepository = $this->em->getRepository(User::class);
            $user = $userRepository->find(1);
            $qb = $this->em->createQueryBuilder();
            $qb
                ->select('l')
                ->from(TapeUser::class, 'l')
                ->innerJoin('l.tape', 't')
                ->innerJoin('t.detail', 'dt')
                ->innerJoin('t.tvShow', 's')
                ->innerJoin('l.history', 'h')
                ->innerJoin('h.details', 'd')
                ->where('l.user = :user')
                ->andWhere('dt.tvShowChapter = :isTvShowChapter')
                ->andWhere('dt.tvShow = :isTvShow')
                ->andWhere('s.finished = :finished')
                ->andWhere('d.visible = :visible')
                ->setParameters([
                    'user' => $user,
                    'isTvShowChapter' => false,
                    'isTvShow' => true,
                    'finished' => false,
                    'visible' => true
                ]);

            $result = $qb->getQuery()->getResult();
            $tvShowsCount = count($result);
            $tvShowsPos = 1;
            /** @var TapeUser $tapeUser */
            foreach ($result as $tapeUser) {
                $startSeason = new DateTimeImmutable();
                $tape = $tapeUser->getTape();
                $tvShow = $tape->getTvShow();
                $lastChapter = $tvShow->getLastChapter();
                $seasonNumber = $lastChapter->getSeason();
                if (!$currentSeason) {
                    $seasonNumber++;
                }
                $output->writeln(sprintf(
                        '<info>%s last season %u importing season %u<info>!',
                        $tape->getOriginalTitle(),
                        $lastChapter->getSeason(),
                        $seasonNumber
                    )
                );
                $this->episodeListMapper
                    ->setSeason($seasonNumber)
                    ->setImdbNumber($tape->getObject()->getImdbNumber()->getImdbNumber())
                    ->setBaseUrl()
                    ->setFullUrl()
                    ->setContentFromUrl();
                $episodeIterator = $this->episodeListMapper->getEpisodes();
                $episodeCount = $episodeIterator->count();
                if ($episodeCount) {
                    $episodePos = 1;
                    /** @var Episode $episode */
                    foreach ($episodeIterator as $episode) {
                        $startEpisode = new DateTimeImmutable();
                        $output->writeln(sprintf(
                                'Found episode %u %s',
                                $episode->getEpisodeNumber(),
                                $episode->getTitle()
                            )
                        );
                        if ($this->checkEpisode($tvShow, $episode)) {
                            $this->movieService->setImdbNumber($episode->getImdbNumber());
                            $this->movieService->import();
                            $tape = $this->movieService->getTape();
                            $this->em->persist($tape);
                            $diff = $startEpisode->diff(new DateTimeImmutable());
                            $output->writeln(sprintf(
                                    'Imported episode %u/%u in %f',
                                    $episodePos,
                                    $episodeCount,
                                    $diff->s + $diff->f
                                )
                            );
                        } else {
                            $output->writeln(sprintf(
                                    '<comment>Episode %u %u/%u ignored</comment>',
                                    $episode->getEpisodeNumber(),
                                    $episodePos,
                                    $episodeCount
                                )
                            );
                        }
                        $episodePos++;
                    }
                    $this->em->flush();
                    $diff = $startSeason->diff(new DateTimeImmutable());
                    $output->writeln(sprintf(
                            "<info>Imported season %u/%u in %'.02u:%f<info>!",
                            $tvShowsPos,
                            $tvShowsCount,
                            $diff->i,
                            $diff->s + $diff->f
                        )
                    );
                } else {
                    $output->writeln(sprintf(
                            "<comment>Not found episodes for season %u %u/%u<comment>!",
                            $seasonNumber,
                            $tvShowsPos,
                            $tvShowsCount
                        )
                    );
                }
                $tvShowsPos++;
            }
        } catch (\Exception $e) {
            $output->writeln(sprintf(
                '<error>%s<error>!',
                $e->getMessage()
            ));
        }
        $diff = $startScript->diff(new DateTimeImmutable());
        $output->writeln(sprintf(
                "<info>Finished in %'.02u:%'.02u:%f<info>!",
                $diff->h,
                $diff->i,
                $diff->s + $diff->f
            )
        );

        return Command::SUCCESS;
    }

    protected function checkEpisode(TvShow $tvShow, Episode $episode): bool
    {
        $chapters = $tvShow->getChapters();
        if (!$chapters->count()) {
            return true;
        }
        $found = false;
        /** @var TvShowChapter $tvShowChapter */
        foreach ($chapters as $tvShowChapter) {
            $imdbNumber = $tvShowChapter->getTape()->getObject()->getImdbNumber()->getImdbNumber();
            if ($imdbNumber === $episode->getImdbNumber()) {
                $premieres = $tvShowChapter->getTape()->getPremieres();
                if (!$premieres->count()) {
                    return true;
                }
                $now = new DateTimeImmutable();
                $minDate = clone $now;
                /** @var Premiere $premiere */
                foreach ($premieres as $premiere) {
                    $date = $premiere->getDate();
                    if ($date < $minDate) {
                        $minDate = $date;
                    }
                }
                if ($minDate < $now) {
                    return false;
                }
                return true;
            }
        }
        if (!$found) {
            return true;
        }

        return false;
    }
}
