<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 07/12/2018
 * Time: 11:51
 */

namespace App\GraphQL\Factory;


use App\GraphQL\Type\Mutation;
use Psr\Container\ContainerInterface;

class MutationFactory
{
    public function __invoke(ContainerInterface $container): Mutation
    {
        return new Mutation($container);
    }
}