<?php

namespace App\Repository;

use App\Entity\LCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LCommande[]    findAll()
 * @method LCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LCommande::class);
    }

    /**
     * @return LCommande[] Returns an array of LCommande objects
     */
    public function findByComm($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.numc = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?LCommande
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
