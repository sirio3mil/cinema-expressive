<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:43
 */

namespace App\Factory;

use App\Resolver\ListTapeUserResolver;
use App\Resolver\ListTvShowChapterUserResolver;
use App\Resolver\TapeResolver;
use App\Service\ResolverManager;
use App\Type\QueryType;
use Psr\Container\ContainerInterface;
use App\Resolver\SearchResolver;
use ReflectionException;

class QueryFactory
{
    /**
     * @param ContainerInterface $container
     * @return QueryType
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): QueryType
    {
        $manager = new ResolverManager($container);
        return new QueryType([
            'fields' => [
                'search' => $manager->get(SearchResolver::class),
                'getTape' => $container->get(TapeResolver::class),
                'listTapeUser' => $container->get(ListTapeUserResolver::class),
                'listTvShowChapterUser' => $container->get(ListTvShowChapterUserResolver::class)
            ]
        ]);
    }
}
