<?php

namespace App\Resolver;

abstract class AbstractResolver implements ResolverInterface
{
    use UserLoggedTrait;

    protected $source;

    /**
     * @return mixed
     */
    public function getSource(): mixed
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource(mixed $source): void
    {
        $this->source = $source;
    }

}
