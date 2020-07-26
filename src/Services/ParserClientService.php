<?php

namespace App\Services;

use App\Interfaces\ParserClientConfiguratorInterface;
use App\Interfaces\ParserClientInterface;
use App\Interfaces\ParserClientServiceInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ParserClientService
 * @package App\Services
 */
class ParserClientService implements ParserClientServiceInterface
{
    /**
     * @var ParserClientInterface
     */
    private $parserClient;

    /**
     * @var ParserClientConfiguratorInterface
     */
    private $config;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * ParserClientService constructor.
     *
     * @param ParserClientInterface $client
     * @param ParserClientConfiguratorInterface $config
     * @param HttpClientInterface $httpClient
     */
    public function __construct(
        ParserClientInterface $client,
        ParserClientConfiguratorInterface $config,
        HttpClientInterface $httpClient
    ) {
        $this->parserClient = $client;
        $this->config = $config;
        $this->httpClient = $httpClient;
    }


    /**
     * @inheritDoc
     */
    public function updateClientStateContent(string $url)
    {
        $this
            ->parserClient
            ->updateClientContent($this->httpClient, $url);
    }

    /**
     * @inheritDoc
     */
    public function getPostsLinksCollection(): array
    {
        return $this
            ->parserClient
            ->getPostsLinksCollection($this->config, $this->httpClient);
    }

    /**
     * @inheritDoc
     */
    public function getPostTitle(): string
    {
        return $this
            ->parserClient
            ->getPostTitle($this->config, $this->httpClient);
    }

    /**
     * @inheritDoc
     */
    public function getPostBody(): string
    {
        return $this
            ->parserClient
            ->getPostBody($this->config, $this->httpClient);
    }

    /**
     * @inheritDoc
     */
    public function getPostImages(): array
    {
        return $this
            ->parserClient
            ->getPostImages($this->config, $this->httpClient);
    }
}
