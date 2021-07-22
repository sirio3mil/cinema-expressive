<?php

namespace App\Command;

use App\Service\ImportImdbMovieService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function sprintf;

class ImportTape extends Command
{
    private EntityManager $em;
    private ImportImdbMovieService $movieService;

    public function __construct(
        EntityManager $entityManager,
        ImportImdbMovieService $movieService
    ) {
        parent::__construct();
        $this->em = $entityManager;
        $this->movieService = $movieService;
    }

    protected function configure()
    {
        $this
            ->addArgument('imdbNumber', InputArgument::REQUIRED, 'Imdb number');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $startScript = new DateTimeImmutable();
        try {
            $imdbNumber = (int)$input->getArgument('imdbNumber');
            $this->movieService->setImdbNumber($imdbNumber);
            $this->movieService->import();
            $tape = $this->movieService->getTape();
            $this->em->persist($tape);
            $this->em->flush();
            $tapeDetail = $tape->getDetail();
            $type = $tapeDetail?->isTvShow() ? 'tv show' : ($tapeDetail?->isTvShowChapter() ? 'chapter' : 'tape');
            $output->writeln(sprintf(
                    'Imported %s %u',
                    $type,
                    $imdbNumber
                )
            );
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
}
