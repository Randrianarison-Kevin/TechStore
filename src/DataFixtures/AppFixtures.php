<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
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
       
        
        

        
        $manager->flush();
    
    }

}
