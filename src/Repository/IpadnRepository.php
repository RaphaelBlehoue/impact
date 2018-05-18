<?php

namespace App\Repository;

use App\Entity\Ipadn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ipadn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ipadn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ipadn[]    findAll()
 * @method Ipadn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpadnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ipadn::class);
    }

    
    public function findAllWithChildren()
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.ipitemadn', 'ip')
            ->addSelect('ip')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Ipadn[] Returns an array of Ipadn objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ipadn
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
