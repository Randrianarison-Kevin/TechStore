<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i<8; $i++){
            $produit = new Produit();
            $produit->setNom('Nom' .$i)
                    ->setDescription('Description'.$i)
                    ->setPrix(mt_rand(10000,100000))
                    ->setQuantite(mt_rand(0,100))
                    ->setImage('img/Image.jpg');
                
            
            $manager->persist($produit);
        }
        $manager->flush();
    }
}
