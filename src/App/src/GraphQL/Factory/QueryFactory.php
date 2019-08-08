<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:43
 */

namespace App\GraphQL\Factory;

use App\GraphQL\Resolver\ListTapeUserResolver;
use App\GraphQL\Resolver\ListTvShowChapterUserResolver;
use App\GraphQL\Resolver\TapeResolver;
use App\GraphQL\Type\QueryType;
use Psr\Container\ContainerInterface;
use App\GraphQL\Resolver\SearchResolver;

class QueryFactory
{
    public function __invoke(ContainerInterface $container): QueryType
    {
        return new QueryType([
            'fields' => [
                'search' => $container->get(SearchResolver::class),
                'getTape' => $container->get(TapeResolver::class),
                'listTapeUser' => $container->get(ListTapeUserResolver::class),
                'listTvShowChapterUser' => $container->get(ListTvShowChapterUserResolver::class)
            ]
        ]);
    }
}