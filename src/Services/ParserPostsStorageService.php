<?php

namespace App\Services;

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
     * @var
     */
    private $posts = [];

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
     * Мне очень стыдно за этот метод... 3 часа ночи)))
     * @Todo Сделать по-человечески.
     * @param array $parsedData
     */
    public function saveParsedData(array $parsedData)
    {
        $parsingEntity = $this->parsingRepository->createParsing();
        $parsingEntity->setCreatedAt(new \DateTime());

        foreach ($parsedData as $data) {
            if (
                '' === trim($data[ParserPostsStorageInterface::PARAMETER_TITLE])
                || '' === trim($data[ParserPostsStorageInterface::PARAMETER_BODY])
                || '' === trim($data[ParserPostsStorageInterface::PARAMETER_URL])
            ) {
                continue;
            }

            $postEntity = $this->postRepository->createNewPost();
            $postEntity->setTitle($data[ParserPostsStorageInterface::PARAMETER_TITLE]);
            $postEntity->setBody($data[ParserPostsStorageInterface::PARAMETER_BODY]);
            $postEntity->setImages(serialize($data[ParserPostsStorageInterface::PARAMETER_IMAGES]));
            $postEntity->setUrl($data[ParserPostsStorageInterface::PARAMETER_URL]);
            $parsingEntity->addPost($postEntity);
            $this->entityManager->persist($postEntity);
        }

        $this->entityManager->persist($parsingEntity);
        $this->entityManager->flush();
    }
}
