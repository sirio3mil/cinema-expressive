<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 22:37
 */

namespace App\GraphQL\Wrapper;


abstract class AbstractWrapper
{
    /**
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public abstract function getData(array $args): array;
}