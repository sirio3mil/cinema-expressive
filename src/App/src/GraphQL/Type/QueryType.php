<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 25/06/2018
 * Time: 18:14
 */

namespace App\GraphQL\Type;

use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use ImdbScraper\Mapper\HomeMapper;

class QueryType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'lastStory' => [
                    'type' => $types->get('blogStory'),
                    'resolve' => function () {
                        return [
                            'id' => 1,
                            'title' => 'Example blog post',
                            'authorId' => 1
                        ];
                    }
                ],
                'getMovie' => [
                    'type' => $types->get('movie'),
                    'args' => [
                        'imdbNumber' => [
                            'type' => Type::int()
                        ]
                    ],
                    'resolve' => function ($source, $args) {
                        /** @var HomeMapper $imdbScrapper */
                        $imdbScrapper = (new HomeMapper())->setImdbNumber($args['imdbNumber'])->setContentFromUrl();
                        return [
                            'year' => $imdbScrapper->getYear(),
                            'title' => $imdbScrapper->getTitle(),
                            'languages' => $imdbScrapper->getLanguages(),
                            'duration' => $imdbScrapper->getDuration(),
                            'color' => $imdbScrapper->getColor(),
                            'recommendations' => $imdbScrapper->getRecommendations(),
                            'countries' => $imdbScrapper->getCountries(),
                            'tvShow' => $imdbScrapper->getTvShow(),
                            'haveReleaseInfo' => $imdbScrapper->haveReleaseInfo(),
                            'isTvShow' => $imdbScrapper->isTvShow(),
                            'isEpisode' => $imdbScrapper->isEpisode(),
                            'genres' => $imdbScrapper->getGenres(),
                            'sounds' => $imdbScrapper->getSounds(),
                            'score' => $imdbScrapper->getScore(),
                            'votes' => $imdbScrapper->getVotes(),
                            'imdbNumber' => $args['imdbNumber']
                        ];
                    }
                ]
            ]
        ]);
    }
}