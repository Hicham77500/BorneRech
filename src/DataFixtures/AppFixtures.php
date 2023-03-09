<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user= new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com'); 
        $user->setPassword('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Hicham');
        $user->setLastname('Guendouz');
        $user->setStreet(' jean moulin');
        $user->setPostalcode('34000');
        $user->setCity('chelles');
        $user->setNumtel('065179593');
        $user->setCarbrand('Tesla');
        $manager->persist($user);
        $manager->flush();
    }
}
