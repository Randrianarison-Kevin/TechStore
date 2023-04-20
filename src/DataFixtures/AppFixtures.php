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
        for($i=0; $i<100; $i++){
            $produit = new Produit();
            $produit->setNom('Nom' .$i)
                    ->setDescription('Description'.$i)
                    ->setPrix(mt_rand(10000,100000))
                    ->setQuantite(mt_rand(0,100))
                    ->setImage($faker->imageUrl());
                
            $imagePath = $produit->getImageFile();        
            
            if ($imagePath) {
                $imageName = pathinfo($imagePath, PATHINFO_FILENAME);
                $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $newFileName = $imageName . '.' . $imageExtension;
                $newFilePath = sys_get_temp_dir() . '/' . $newFileName;
                copy($imagePath, $newFilePath);
                $imageFile = new File($newFilePath);
                $produit->setImageFile($imageFile);
            }
            $manager->persist($produit);
        }
        $manager->flush();
    }
}
