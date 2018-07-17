<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 16:40
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use ImdbScraper\Model\CastPeople;
use ImdbScraper\Model\People;

class CrewType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'cast' => Type::listOf($types->get('cast')),
                'writers' => Type::listOf($types->get('writer')),
                'directors' => Type::listOf($types->get('director'))
            ],
            'resolveField' => function($source, $args, $context, ResolveInfo $info) {
                switch ($info->fieldName) {
                    case 'cast':
                        $data = [];
                        if($source['cast']){
                            /** @var CastPeople $cast */
                            foreach ($source['cast'] as $cast) {
                                $data[] = [
                                    'fullName' => $cast->getFullName(),
                                    'imdbNumber' => $cast->getImdbNumber(),
                                    'character' => $cast->getCharacter(),
                                    'alias' => $cast->getAlias()
                                ];
                            }
                        }
                        return $data;
                    case 'writers':
                        $data = [];
                        if($source['writers']){
                            /** @var People $person */
                            foreach ($source['cast'] as $person) {
                                $data[] = [
                                    'fullName' => $person->getFullName(),
                                    'imdbNumber' => $person->getImdbNumber()
                                ];
                            }
                        }
                        return $data;
                    case 'directors':
                        $data = [];
                        if($source['directors']){
                            /** @var People $person */
                            foreach ($source['cast'] as $person) {
                                $data[] = [
                                    'fullName' => $person->getFullName(),
                                    'imdbNumber' => $person->getImdbNumber()
                                ];
                            }
                        }
                        return $data;
                    default:
                        return null;
                }
            }
        ]);
    }
}