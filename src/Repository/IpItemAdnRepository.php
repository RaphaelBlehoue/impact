<?php

namespace App\Repository;

use App\Entity\IpItemAdn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IpItemAdn|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpItemAdn|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpItemAdn[]    findAll()
 * @method IpItemAdn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpItemAdnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IpItemAdn::class);
    }

//    /**
//     * @return IpItemAdn[] Returns an array of IpItemAdn objects
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
    public function findOneBySomeField($value): ?IpItemAdn
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
