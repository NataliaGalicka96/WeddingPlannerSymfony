<?php

namespace App\Repository;

use App\Entity\PodcategoryDefault;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PodcategoryDefault>
 *
 * @method PodcategoryDefault|null find($id, $lockMode = null, $lockVersion = null)
 * @method PodcategoryDefault|null findOneBy(array $criteria, array $orderBy = null)
 * @method PodcategoryDefault[]    findAll()
 * @method PodcategoryDefault[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PodcategoryDefaultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PodcategoryDefault::class);
    }

    public function add(PodcategoryDefault $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PodcategoryDefault $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PodcategoryDefault[] Returns an array of PodcategoryDefault objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PodcategoryDefault
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
