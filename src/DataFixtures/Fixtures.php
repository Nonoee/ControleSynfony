<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Contact;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            $faker = Factory::create('FR-fr');

            for($i=1; $i<=3; $i++)
            { 
                $categorie1= new Categorie();
                $categorie1->setDesignation("comnaissance");
                $manager->persist($categorie1);

                $categorie2= new Categorie();
                $categorie2->setDesignation("professionel");
                $manager->persist($categorie2);

                $categorie3= new Categorie();
                $categorie3->setDesignation("amis");
                $manager->persist($categorie3);

                $cats=[$categorie1,$categorie2,$categorie3];

                $faker=Factory::create("fr_FR");
                for($i =0; $i <=20; $i++){

                    $contact= new Contact();

                    $contact->setNOM($faker->lastName())
                            ->setPrenom($faker->firstName())
                            ->setAdresse($faker->streetAddress())
                            ->setCodePostal($faker->postcode())
                            ->setVille($faker->city())
                            ->setNumTel($faker->phoneNumber())
                            ->setadresseMail($faker->email())
                            ->setUrlAvatar($faker->imageUrl($width =300, $height =200))
                            ->setCategorie($cats[mt_rand(0,2)]);

                    $manager->persist($contact);
                }
            }
        $manager->flush();
    }
}