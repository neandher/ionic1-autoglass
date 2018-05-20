<?php

namespace App\Repository;

use App\Entity\Pergunta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pergunta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pergunta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pergunta[]    findAll()
 * @method Pergunta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerguntaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pergunta::class);
    }

//    /**
//     * @return Pergunta[] Returns an array of Pergunta objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pergunta
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
