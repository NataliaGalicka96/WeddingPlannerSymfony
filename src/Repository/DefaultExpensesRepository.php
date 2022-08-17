<?php

namespace App\Repository;

use App\Entity\DefaultExpenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DefaultExpenses>
 *
 * @method DefaultExpenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefaultExpenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefaultExpenses[]    findAll()
 * @method DefaultExpenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefaultExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DefaultExpenses::class);
    }

    public function add(DefaultExpenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DefaultExpenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DefaultExpenses[] Returns an array of DefaultExpenses objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DefaultExpenses
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
