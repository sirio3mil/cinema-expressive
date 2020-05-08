<?php

namespace App\Factory;

use App\Type\TvShowChapterPageType;
use GraphQL\Doctrine\Types;
use Psr\Container\ContainerInterface;

class TvShowChapterPageTypeFactory
{
    /**
     * @param ContainerInterface $container
     * @return TvShowChapterPageType
     */
    public function __invoke(ContainerInterface $container): TvShowChapterPageType
    {
        /** @var Types $types */
        $types = $container->get(Types::class);
        return new TvShowChapterPageType($types);
    }
}
