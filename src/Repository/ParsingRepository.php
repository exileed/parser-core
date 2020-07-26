<?php

namespace App\Repository;

use App\Entity\Parsing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parsing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parsing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parsing[]    findAll()
 * @method Parsing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParsingRepository extends ServiceEntityRepository
{
    /**
     * ParsingRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parsing::class);
    }

    /**
     * @param int $limit
     * @param int $offset
     *
     * @return Parsing[]
     */
    public function findAllLimited(int $limit = 15, int $offset = 0): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return Parsing|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById(int $id): ?Parsing
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Parsing|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLastOne(): ?Parsing
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Parsing
     */
    public function createParsing()
    {
        return new Parsing();
    }
}
