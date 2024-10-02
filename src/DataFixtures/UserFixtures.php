<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Subscription;
use App\Entity\Media;
use App\Entity\Playlist;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail(email: 'test1@example.com');
        $user->setUsername(username: 'test1');
        $user->setPassword(password: 'pwd');

        $user2 = new User();
        $user2->setEmail(email: 'test2@example.com');
        $user2->setUsername(username: 'test2');
        $user2->setPassword(password: 'pwd');

        $user3 = new User();
        $user3->setEmail(email: 'test3@example.com');
        $user3->setUsername(username: 'test3');
        $user3->setPassword(password: 'pwd');

        $abonnements = new Subscription();
        $abonnements->setDuration(10);
        $abonnements->setName('Abonnement 10 jours');
        $abonnements->setPrice(50);

        $media = new Media();
        $media->setTitle('title1');
        $media->setLongDescription(longDescription: 'Long description');
        $media->setShortDescription(shortDescription: 'Short description');
        $media->setCoverImage(coverImage: '');
        $media->setReleaseDate(releaseDate: new \DateTime(datetime: "+7 days"));

        $playlist = new Playlist();
        $playlist->setName('Playlist1');
        $playlist->setCreatedAt(new \DateTimeImmutable());
        $playlist->setUpdatedAt(new \DateTimeImmutable());
        $playlist->setCreator($user);

        $manager->persist($user);
        $manager->persist($abonnements);
        $manager->persist($media);
        $manager->persist($playlist);


        $manager->flush();
    }
}
