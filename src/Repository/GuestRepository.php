<?php

namespace App\Repository;

use App\Entity\Guest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guest>
 *
 * @method Guest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guest[]    findAll()
 * @method Guest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guest::class);
    }

    public function add(Guest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Guest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getGuestAssignedToUser($userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM guest
        WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();
    }


    public function getSummaryOfGuest($userId)
    {

        $conn= $this->getEntityManager()->getConnection();
        $sql = "SELECT COUNT(name) AS numberOfGuest, 
        (SELECT COUNT(is_confirmed) FROM guest WHERE  user_id = :user_id and is_confirmed = 1) as confirmed,
        (SELECT COUNT(is_accommodation) FROM guest WHERE  user_id = :user_id and is_accommodation = 1) as accommodation,
        (SELECT COUNT(transport) FROM guest WHERE  user_id = :user_id and transport = 1) as transport,
        (SELECT COUNT(is_adult) FROM guest WHERE  user_id = :user_id and is_adult = 1) as adult,
        (SELECT COUNT(is_child_under_3_years) FROM guest WHERE  user_id = :user_id and is_child_under_3_years = 1) as childUnderThree,
        (SELECT COUNT(is_child_between_3_12_years) FROM guest WHERE  user_id = :user_id and is_child_between_3_12_years = 1) as childOverThree,
        (SELECT COUNT(special_diet) FROM guest WHERE  user_id = :user_id and special_diet = 1) as Diet
        FROM guest
        WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();
    }
//    /**
//     * @return Guest[] Returns an array of Guest objects
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

//    public function findOneBySomeField($value): ?Guest
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
