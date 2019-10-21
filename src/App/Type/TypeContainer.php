<?php

namespace App\Type;

use Jasny\Container\Container;
use Psr\Container\ContainerInterface;

class TypeContainer extends Container
{
    /**
     * TypeContainer constructor.
     * @param iterable $entries
     * @param ContainerInterface|null $delegateLookupContainer
     */
    public function __construct(iterable $entries, ContainerInterface $delegateLookupContainer = null)
    {
        parent::__construct($entries, $delegateLookupContainer);
    }

    /**
     * @inheritDoc
     */
    protected function assertType($instance, string $identifier): void
    {
    }
}
