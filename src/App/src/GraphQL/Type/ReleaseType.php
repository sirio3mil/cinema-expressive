<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 17/07/2018
 * Time: 18:08
 */

namespace App\GraphQL\Type;


use App\GraphQL\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use ImdbScraper\Model\AlsoKnownAs;
use ImdbScraper\Model\Release;

class ReleaseType extends ObjectType
{
    public function __construct(TypeRegistry $types)
    {
        parent::__construct([
            'fields' => [
                'dates' => Type::listOf($types->get('releaseDate')),
                'titles' => Type::listOf($types->get('alternativeTitle'))
            ],
            'resolveField' => function($source, $args, $context, ResolveInfo $info) {
                switch ($info->fieldName) {
                    case 'dates':
                        $data = [];
                        if($source['dates']){
                            /** @var Release $release */
                            foreach ($source['dates'] as $release) {
                                $data[] = [
                                    'details' => $release->getDetails(),
                                    'date' => $release->getDate()->format("Y-m-d"),
                                    'country' => $release->getCountry()
                                ];
                            }
                        }
                        return $data;
                    case 'titles':
                        $data = [];
                        if($source['titles']){
                            /** @var AlsoKnownAs $knownAs */
                            foreach ($source['titles'] as $knownAs) {
                                $data[] = [
                                    'country' => $knownAs->getCountry(),
                                    'title' => $knownAs->getTitle(),
                                    'description' => $knownAs->getDescription()
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