<?php

namespace App\Services;

use App\Exceptions\ParserClientErrorException;
use App\Interfaces\ParsedEntityContractInterface;
use App\Interfaces\ParserClientServiceInterface;
use App\Interfaces\ParserDispatcherInterface;
use App\Interfaces\ParserPostsStorageInterface;
use Psr\Log\LoggerInterface;

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
     * @var ParsedEntityContractInterface
     */
    private $parsedEntityBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ParserDispatcherService constructor.
     *
     * @param ParserClientServiceInterface $service
     * @param ParserPostsStorageInterface $storage
     * @param ParsedEntityContractInterface $parsedEntityBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        ParserClientServiceInterface $service,
        ParserPostsStorageInterface $storage,
        ParsedEntityContractInterface $parsedEntityBuilder,
        LoggerInterface $logger
    ) {
        $this->parserService = $service;
        $this->storage = $storage;
        $this->parsedEntityBuilder = $parsedEntityBuilder;
        $this->logger = $logger;
    }


    /**
     * @inheritDoc
     */
    public function dispatch()
    {
        try {
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
        } catch (ParserClientErrorException $exception) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }

        $this->storage->saveParsedData($data);
    }
}
