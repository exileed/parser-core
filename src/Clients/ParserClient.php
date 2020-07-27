<?php

namespace App\Clients;

use App\Interfaces\ParserClientConfiguratorInterface;
use App\Interfaces\ParserClientInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ParserClient
 * @package App\Clients
 */
class ParserClient implements ParserClientInterface
{
    /**
     * @var ParserClientTerminalInterface
     */
    private $parserTerminal;

    /**
     * ParserClient constructor.
     * @param ParserClientTerminalInterface $parserTerminal
     */
    public function __construct(ParserClientTerminalInterface $parserTerminal)
    {
        $this->parserTerminal = $parserTerminal;
    }

    /**
     * @inheritDoc
     */
    public function getPostsLinksCollection(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): array
    {

        $this->updateClientContent($httpClient, $this->createSourceString($configurator));

        return $this->parserTerminal->filter($configurator->getSelectorPostInList())->extract(['href']);
    }

    /**
     * @inheritDoc
     */
    public function getPostTitle(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): string
    {
        $filteredDom = $this->parserTerminal->filter($configurator->getSelectorPostDetailTitle())->first();
        if ($filteredDom->count() > 0) {
            return $filteredDom->text();
        }
        return '';

    }

    /**
     * @inheritDoc
     */
    public function getPostBody(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): string
    {
        $filteredDom = $this->parserTerminal->filter($configurator->getSelectorPostDetailBody())->first();
        if ($filteredDom->count() > 0) {
            return $filteredDom->text();
        }
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getPostImages(
        ParserClientConfiguratorInterface $configurator,
        HttpClientInterface $httpClient
    ): array
    {
        return $this->parserTerminal->filter($configurator->getSelectorPostDetailImage())->extract(['src']);
    }

    /**
     * @param HttpClientInterface $httpClient
     * @param string $url
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function updateClientContent(HttpClientInterface $httpClient, string $url)
    {
        $this->parserTerminal->clear();
        $this->parserTerminal->add($httpClient->request('GET', $url)->getContent());
    }

    /**
     * @param ParserClientConfiguratorInterface $configurator
     *
     * @return string
     */
    private function createSourceString(ParserClientConfiguratorInterface $configurator)
    {
        return sprintf(
            '%s://%s',
            $configurator->getProtocol(),
            $configurator->getHost()
        );
    }
}
