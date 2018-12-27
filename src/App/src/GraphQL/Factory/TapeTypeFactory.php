<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 27/12/2018
 * Time: 16:13
 */

namespace App\GraphQL\Factory;


use App\Entity\Language;
use App\GraphQL\Type\MovieType;
use GraphQL\Doctrine\Types;
use GraphQL\Type\Definition\Type;
use Psr\Container\ContainerInterface;

class TapeTypeFactory
{
    public function __invoke(ContainerInterface $container): MovieType
    {

        /** @var Types $types */
        $types = $container->get(Types::class);

        return new MovieType([
            'fields' => [
                'year' => Type::int(),
                'title' => Type::string(),
                'duration' => Type::int(),
                'color' => Type::string(),
                'isTvShow' => Type::boolean(),
                'imdbNumber' => Type::int(),
                'languages' => Type::listOf($types->getOutput(Language::class))
            ]
        ]);
    }
}