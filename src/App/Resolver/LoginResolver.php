<?php

namespace App\Resolver;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\ServerRequest;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use function json_decode;

class LoginResolver extends AbstractResolver implements QueryResolverInterface
{
    /**
     * @var AuthorizationServer
     */
    private AuthorizationServer $server;

    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var array
     */
    private array $config;

    /**
     * @var callable
     */
    private $responseFactory;

    /**
     * LoginResolver constructor.
     * @param AuthorizationServer $server
     * @param EntityManager $entityManager
     * @param callable $responseFactory
     * @param array $config
     */
    public function __construct(
        AuthorizationServer $server,
        EntityManager $entityManager,
        callable $responseFactory,
        array $config
    ) {
        $this->server = $server;
        $this->entityManager = $entityManager;
        $this->config = $config['oauth'] ?? [];
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    protected function execute(string $username, string $password): User
    {
        $repository = $this->entityManager->getRepository(User::class);
        /** @var User $user */
        $user = $repository->findOneBy([
            'username' => $username
        ]);

        return $user;
    }

    /**
     * @inheritDoc
     * @throws OAuthServerException
     */
    public function resolve(array $args)
    {
        foreach ($this->config as $key => $value) {
            $args[$key] ??= $value;
        }
        $request = (new ServerRequest())->withParsedBody($args);
        /** @var Response $response */
        $response = $this->server->respondToAccessTokenRequest($request, $this->createResponse());

        $user = $this->execute($args['username'], $args['password']);
        $stream = $response->getBody();
        $stream->rewind();
        $data = json_decode($stream->getContents(), true);
        $user->setToken($data['access_token']);

        return $user;
    }

    /**
     * @return ResponseInterface
     */
    private function createResponse(): ResponseInterface
    {
        return ($this->responseFactory)();
    }
}
