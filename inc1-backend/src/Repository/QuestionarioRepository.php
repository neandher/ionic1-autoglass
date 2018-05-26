<?php

namespace App\Repository;

use App\Entity\Questionario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Questionario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questionario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questionario[]    findAll()
 * @method Questionario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Questionario::class);
    }

//    /**
//     * @return Questionario[] Returns an array of Questionario objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Questionario
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
