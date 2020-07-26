<?php

namespace App\Services;

use App\Interfaces\ParsedEntityContractInterface;
use App\Interfaces\ParserClientServiceInterface;
use App\Interfaces\ParserDispatcherInterface;
use App\Interfaces\ParserPostsStorageInterface;

/**
 * Class ParserDispatcherService
 *
 * @package App\Services
 */
class ParserDispatcherService implements ParserDispatcherInterface
{

    /**
     * @var ParserClientServiceInterface
     */
    private $parserService;

    /**
     * @var ParserPostsStorageInterface
     */
    private $storage;

    private $parsedEntityBuilder;

    /**
     * ParserDispatcherService constructor.
     *
     * @param ParserClientServiceInterface $service
     * @param ParserPostsStorageInterface $storage
     * @param ParsedEntityContractInterface $parsedEntityBuilder
     */
    public function __construct(
        ParserClientServiceInterface $service,
        ParserPostsStorageInterface $storage,
        ParsedEntityContractInterface $parsedEntityBuilder
    ) {
        $this->parserService = $service;
        $this->storage = $storage;
        $this->parsedEntityBuilder = $parsedEntityBuilder;
    }


    /**
     * @inheritDoc
     */
    public function dispatch()
    {
        $postsReferencesCollection = $this->parserService->getPostsLinksCollection();

        $data = [];
        foreach ($postsReferencesCollection as $url) {
            $this->parserService->updateClientStateContent($url);
            $parsedAdaptedEntity = $this->parsedEntityBuilder->getParsedEntity();
            $parsedAdaptedEntity->setUrl($url);
            $parsedAdaptedEntity->setTitle($this->parserService->getPostTitle());
            $parsedAdaptedEntity->setBody($this->parserService->getPostBody());
            $parsedAdaptedEntity->setImages($this->parserService->getPostImages());
            $data[] = $parsedAdaptedEntity;
        }

        $this->storage->saveParsedData($data);
    }



}