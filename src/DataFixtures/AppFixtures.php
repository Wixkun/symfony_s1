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
        // Exemple : Création de 3 utilisateurs
        $user1 = new User();
        $user1->setEmail('user1@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'password123');
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $admin = new User();
        $admin->setEmail('admin@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $superAdmin = new User();
        $superAdmin->setEmail('superadmin@example.com');
        $hashedPassword = $this->passwordHasher->hashPassword($superAdmin, 'superpassword');
        $superAdmin->setPassword($hashedPassword);
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($superAdmin);

        $manager->flush();
    }
}
