<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setEmail('user1@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'password123');
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $admin = new User();
        $admin->setUsername('admin'); 
        $admin->setEmail('admin@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $bannedUser = new User();
        $bannedUser->setUsername('banned'); 
        $bannedUser->setEmail('banned@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($bannedUser, 'bannedpassword');
        $bannedUser->setPassword($hashedPassword);
        $bannedUser->setRoles(['ROLE_BANNED']);
        $manager->persist($bannedUser);

        $manager->flush();
    }
}
