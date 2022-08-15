<?php

namespace App\Repository;

use App\Entity\CheckListPodcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckListPodcategory>
 *
 * @method CheckListPodcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckListPodcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckListPodcategory[]    findAll()
 * @method CheckListPodcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckListPodcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckListPodcategory::class);
    }

    public function add(CheckListPodcategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CheckListPodcategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*
    public function getPodcategoryAssignedToUser($userId)
    {
        
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM check_list_podcategory_assigned_to_users 
        WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();

    }
    */

    public function getNameOfCategory($userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM check_list_assigned_to_user AS clpatu
        JOIN check_list_podcategory clp ON clp.name = clpatu.name
        WHERE clpatu.user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();
    }





//    /**
//     * @return CheckListPodcategory[] Returns an array of CheckListPodcategory objects
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

//    public function findOneBySomeField($value): ?CheckListPodcategory
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
