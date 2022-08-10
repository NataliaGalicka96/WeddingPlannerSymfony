<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager): void
    {

        $user = new User();

        $user->setUsername(username: 'admin');
        $user->setEmail(email: 'admin@localhost.local');
        $user->setRoles(['ROLES_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, plainPassword: 'qwerty123'));

        $manager->persist($user);
        $manager->flush();
    }
}
