<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }


  
    public function copy_default_podcategory_task()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='INSERT INTO check_list_assigned_to_user (user_id, name, category_id) 
        SELECT user.id, check_list_podcategory.name, check_list_podcategory.category_id 
        FROM user, check_list_podcategory 
        WHERE user.id = (SELECT max(id) FROM user)';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
        
    }

    /*
    public function copy_default_category_task()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='INSERT INTO check_category_assigned_to_user (user_id, name)
        SELECT user.id, check_list_category.name
        FROM user, check_list_category
        WHERE user.id = (SELECT max(id) FROM user)';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }

    public function copy_default_task()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='INSERT INTO check_category_assigned_to_user (user_id, name)
        SELECT user.id, check_list_category.name
        FROM user, check_list_category
        WHERE user.id = (SELECT max(id) FROM user)';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }
    */

    public function copy_default_task()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='INSERT INTO check_list (user_id, category_name, task)
        SELECT user.id, task_to_do.category_name, task_to_do.task
        FROM user, task_to_do
        WHERE user.id = (SELECT max(id) FROM user)';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();

    }
    


    
//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
