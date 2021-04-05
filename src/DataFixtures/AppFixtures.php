<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Provider\bg_BG\PhoneNumber;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    
    private $encoder;

    function __construct(UserPasswordEncoderInterface $encoder)
    {
       $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        
        
        
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('fr_FR');
        $users = [];
        
        $user = new User();
        $user->setEmail('julie.j@gmail.com')
        ->setNom($faker->name())
        ->setPrenom($faker->lastName())
        ->setTelephone($faker->PhoneNumber())
        ->setAPropos($faker->text())
        ->setInstagram($faker->url());

        $password=$this->encoder->encodePassword($user,'password');
        $user->setPassword($password);
        
        $manager ->persist($user);
        $users[] = $user;


        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setNom($faker->name());
            $user->setPrenom($faker->lastName());
            $user->setTelephone($faker->PhoneNumber());
            $user->setAPropos($faker->text());
            $user->setInstagram($faker->url());


                 $password=$this->encoder->encodePassword($user,'password');
                 $user->setPassword($password);

                 $manager ->persist($user);
                 $users[] = $user;

                 for ($j=0; $j < 10; $j++) { 
                     $blogpost = new Blogpost();
                     $blogpost->setTitre($faker->word(4, true))
                     ->setContenu($faker->text(350))
                     ->setSlug($faker->slug(4))
                     ->setCreatedAt($faker->dateTimeBetween('-6 months', 'now'))
                     ->setUser($users[mt_rand(0, count($users) -1)]);
         
                     $manager->persist($blogpost);            # code...
                 }

                //  fin des instructions concernant la boucle entre User et BlogPost
        }

        for ($k=0; $k < 5; $k++) { 
            # code...
            $categorie=new Categorie();
            $categorie->setSlug($faker->slug(4))
            ->setDescription($faker->word(10, true))
            ->setNom($faker->word(4,true));

            $manager->persist($categorie);

for ($l=0; $l <2 ; $l++) { 
    # code...
    $peinture = new Peinture;
    $peinture->setNom($faker->word(5))
    ->setLargeur($faker->randomFloat(2,20,60))
    ->setHauteur($faker->randomFloat(2,20,60))
    ->setEnVente($faker->randomElement([true, false]))
    ->setDateRealisation($faker->dateTimeBetween('-6 months','now'))
    ->setCreatedAt($faker->dateTimeBetween('-6 months','now'))
    ->setDescription($faker->text(500))
    ->setPortfolio($faker->randomElement([true, false]))
    ->addCategorie($categorie)
    ->setSlug($faker->slug(5))
    ->setPrix($faker->randomFloat(2,100,9999))
    ->setUser($users[mt_rand(0, count($users) -1)])
    ->setFile($faker->imageUrl(640, 480, true));

    $manager->persist($peinture);


}


        }


        $manager->flush();
    }
}
