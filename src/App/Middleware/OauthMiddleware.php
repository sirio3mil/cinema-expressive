<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class OauthMiddleware implements MiddlewareInterface
{
    private $config;


    /**
     * OauthMiddleware constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        foreach ($this->config as $key => $value){
            $parsedBody[$key] = $parsedBody[$key] ?? $value;
        }
        $new = $request->withParsedBody($parsedBody);
        return $handler->handle($new);
    }
}
