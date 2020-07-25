<?php

namespace App\Services;

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


    /**
     * ParserDispatcherService constructor.
     *
     * @param ParserClientServiceInterface $service
     * @param ParserPostsStorageInterface $storage
     */
    public function __construct(ParserClientServiceInterface $service, ParserPostsStorageInterface $storage)
    {
        $this->parserService = $service;
        $this->storage = $storage;
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
            $data[] = [
                ParserPostsStorageInterface::PARAMETER_URL => $url,
                ParserPostsStorageInterface::PARAMETER_TITLE => $this->parserService->getPostTitle(),
                ParserPostsStorageInterface::PARAMETER_BODY => $this->parserService->getPostBody(),
                ParserPostsStorageInterface::PARAMETER_IMAGES => $this->parserService->getPostImages()
            ];
        }

        $this->storage->saveParsedData($data);
    }



}