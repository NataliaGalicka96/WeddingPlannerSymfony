<?php

namespace App\Repository;

use App\Entity\WeddingSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeddingSettings>
 *
 * @method WeddingSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeddingSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeddingSettings[]    findAll()
 * @method WeddingSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeddingSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeddingSettings::class);
    }

    public function add(WeddingSettings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WeddingSettings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDataOfWedding($userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM wedding_settings
        WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $userId]);


        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return WeddingSettings[] Returns an array of WeddingSettings objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WeddingSettings
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
