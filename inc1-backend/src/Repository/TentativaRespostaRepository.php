<?php

namespace App\Repository;

use App\Entity\TentativaResposta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TentativaResposta|null find($id, $lockMode = null, $lockVersion = null)
 * @method TentativaResposta|null findOneBy(array $criteria, array $orderBy = null)
 * @method TentativaResposta[]    findAll()
 * @method TentativaResposta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativaRespostaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TentativaResposta::class);
    }

//    /**
//     * @return TentativaResposta[] Returns an array of TentativaResposta objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TentativaResposta
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
