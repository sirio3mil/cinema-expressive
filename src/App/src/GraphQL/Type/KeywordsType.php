<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 19/07/2018
 * Time: 13:04
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use ImdbScraper\Model\Keyword;

class KeywordsType extends ObjectType
{
    public function __construct(TypeRegistry $typeRegistry)
    {
        parent::__construct([
            'fields' => [
                'total' => Type::int(),
                'keywords' => [
                    'type' => Type::listOf($typeRegistry->get('keyword')),
                    'resolve' => function($source) {
                        $data = [];
                        if($source['keywords']){
                            /** @var Keyword $keyword */
                            foreach ($source['keywords'] as $keyword) {
                                $data[] = [
                                    'keyword' => $keyword->getKeyword(),
                                    'imdbNumber' => $keyword->getImdbNumber(),
                                    'url' => $keyword->getUrl(),
                                    'totalVotes' => $keyword->getTotalVotes(),
                                    'relevantVotes' => $keyword->getRelevantVotes()
                                ];
                            }
                        }
                        return $data;
                    }
                ]
            ]
        ]);
    }
}