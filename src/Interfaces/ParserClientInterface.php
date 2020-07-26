<?php

namespace App\Interfaces;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Interface ParserClientInterface
 * @package App\Interfaces
 */
interface ParserClientInterface
{
    /**
     * @param HttpClientInterface $httpClient
     * @param string $url
     *
     * @return void
     */
    public function updateClientContent(HttpClientInterface $httpClient, string $url);

    /**
     * @param ParserClientConfiguratorInterface $configurator
     * @param HttpClientInterface $httpClient
     *
     * @return string[]
     */
    public function getPostsLinksCollection(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): array ;

    /**
     * @param ParserClientConfiguratorInterface $configurator
     * @param HttpClientInterface $httpClient
     *
     * @return string
     */
    public function getPostTitle(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): string ;

    /**
     * @param ParserClientConfiguratorInterface $configurator
     * @param HttpClientInterface $httpClient
     *
     * @return string
     */
    public function getPostBody(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): string ;

    /**
     * @param ParserClientConfiguratorInterface $configurator
     * @param HttpClientInterface $httpClient
     *
     * @return string[]
     */
    public function getPostImages(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): array ;
}
