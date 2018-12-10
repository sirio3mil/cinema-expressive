<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 13:01
 */

namespace App\GraphQL\Resolver;


use ImdbScraper\Mapper\KeywordMapper;
use Psr\Container\ContainerInterface;

class MovieKeywordResolver
{

    /**
     * @param ContainerInterface $container
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(ContainerInterface $container, array $args): array
    {
        /** @var KeywordMapper $mapper */
        $mapper = $container->get(KeywordMapper::class);
        $mapper->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
        return [
            'total' => $mapper->getTotalKeywords(),
            'keywords' => $mapper->getKeywords()
        ];
    }
}