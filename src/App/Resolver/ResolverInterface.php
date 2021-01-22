<?php

namespace App\Resolver;

interface ResolverInterface
{
    /**
     * @param array $args
     * @return mixed
     */
    public function resolve(array $args);
}
