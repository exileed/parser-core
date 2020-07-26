<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    const POST_PER_PARSING = 15;

    /**
     * PostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @param int $parsingId
     *
     * @return Post[]
     */
    public function findAllByParsing(int $parsingId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.parsing_id = :parsing')
            ->setParameter('parsing', $parsingId)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(self::POST_PER_PARSING)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     *
     * @return Post|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById($id): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Post
     */
    public function createNewPost()
    {
        return new Post();
    }
}
