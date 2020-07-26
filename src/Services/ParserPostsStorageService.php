<?php

namespace App\Services;

use App\Interfaces\ParsedEntityContractInterface;
use App\Interfaces\ParserPostsStorageInterface;
use App\Repository\ParsingRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ParserPostsStorageService
 * @package App\Services
 */
class ParserPostsStorageService implements ParserPostsStorageInterface
{
    /**
     * @var ParsingRepository
     */
    private $parsingRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ParserPostsStorageService constructor.
     *
     * @param ParsingRepository $parsingRepository
     * @param PostRepository $postRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ParsingRepository $parsingRepository,
        PostRepository $postRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->parsingRepository = $parsingRepository;
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param ParsedEntityContractInterface[] $parsedContractEntities
     */
    public function saveParsedData(array $parsedContractEntities)
    {
        $parsingEntity = $this->parsingRepository->createParsing();
        $parsingEntity->setCreatedAt(new \DateTime());

        foreach ($parsedContractEntities as $parsedContractEntity) {
            if (
                '' === $parsedContractEntity->getTitle()
                || '' === $parsedContractEntity->getBody()
                || '' === $parsedContractEntity->getUrl()
            ) {
                continue;
            }

            $postEntity = $this->postRepository->createNewPost();
            $postEntity->setTitle($parsedContractEntity->getTitle());
            $postEntity->setBody($parsedContractEntity->getBody());
            $postEntity->setImages($parsedContractEntity->getImages());
            $postEntity->setUrl($parsedContractEntity->getUrl());
            $parsingEntity->addPost($postEntity);
            $this->entityManager->persist($postEntity);
        }

        $this->entityManager->persist($parsingEntity);
        $this->entityManager->flush();
    }
}
