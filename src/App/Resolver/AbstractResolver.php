<?php

namespace App\Resolver;

abstract class AbstractResolver implements ResolverInterface
{
    use UserLoggedTrait;

    protected $source;

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }

}
