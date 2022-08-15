<?php

namespace App\Repository;

use App\Entity\CheckCategoryAssignedToUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckCategoryAssignedToUser>
 *
 * @method CheckCategoryAssignedToUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckCategoryAssignedToUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckCategoryAssignedToUser[]    findAll()
 * @method CheckCategoryAssignedToUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckCategoryAssignedToUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckCategoryAssignedToUser::class);
    }

    public function add(CheckCategoryAssignedToUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CheckCategoryAssignedToUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*
    public function getCategoryAssignedToUser($userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM check_category_assigned_to_user
                WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();
    }
    */




//    /**
//     * @return CheckCategoryAssignedToUser[] Returns an array of CheckCategoryAssignedToUser objects
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

//    public function findOneBySomeField($value): ?CheckCategoryAssignedToUser
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
