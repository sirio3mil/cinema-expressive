<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 26/12/2018
 * Time: 11:44
 */

namespace App\GraphQL\Resolver;

use App\Entity\Tape;
use App\Entity\TapeDetail;
use InvalidArgumentException;

class MovieDetailResolver
{

    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function resolve(array $args): array
    {
        /** @var Tape $tape */
        $tape = $args['tapeId']->getEntity();
        if (!$tape) {
            throw new InvalidArgumentException('Tape not found');
        }
        /** @var TapeDetail $detail */
        $detail = $tape->getDetail();
        return [
            'year' => $detail->getYear(),
            'title' => $tape->getOriginalTitle(),
            'duration' => $detail->getDuration(),
            'color' => $detail->getColor(),
            'isTvShow' => $detail->getIsTvShow(),
            'imdbNumber' => $tape->getObject()->getImdbNumber()->getImdbNumber()
        ];
    }
}