<?php

namespace App\Repository;

use App\Entity\CheckListAssignedToUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckListAssignedToUser>
 *
 * @method CheckListAssignedToUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckListAssignedToUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckListAssignedToUser[]    findAll()
 * @method CheckListAssignedToUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckListAssignedToUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckListAssignedToUser::class);
    }

    public function add(CheckListAssignedToUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CheckListAssignedToUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CheckListAssignedToUser[] Returns an array of CheckListAssignedToUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CheckListAssignedToUser
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
