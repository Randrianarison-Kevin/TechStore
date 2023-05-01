<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private Generator $faker;


    public function __construct()
    {
        $this ->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        for($i=0; $i<5; $i++){
            $categories = new Categories();
            $categories->setNom('Nom' .$i)
                    ->setDescription('Description'.$i);
            $manager->persist($categories);
       
       
            for($j=0; $j<8; $j++){
                $produit = new Produit();
                $produit->setNom('Nom' .$j)
                        ->setDescription('Description'.$j)
                        ->setPrix(mt_rand(10000,100000))
                        ->setQuantite(mt_rand(0,100))
                        ->setCategories($categories)
                        ->setImage('img/Image.jpg');          
                $manager->persist($produit);     
            }
           
        }
       
        for ($i=0; $i < 10 ; $i++) { 
            $user = new User;
            $user   -> setUsername($this->faker->name())
                    ->setEmail($this ->faker ->email())
                    ->setRoles(['ROLE_USER'])
                    ->setPlainPassword($this->faker -> password());
            $manager ->persist($user);
        }
        
        

        
        $manager->flush();
    
    }

}
