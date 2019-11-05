<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Game;
use App\Entity\Developer;
use App\Entity\Genre;
use App\Entity\Mode;
use App\Entity\Publisher;
use App\Entity\Region;
use App\Entity\Platform;
use App\Entity\ReleaseDate;
use App\Entity\Comment;
// use App\Entity\Member;
use App\Entity\Role;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 5; $i++) {
            $developer = new Developer();
            $developer->setName($faker->company());

            $arrayDeveloper [] = $developer; 

            $manager->persist($developer);
        }

        for($i = 1; $i <= 5; $i++) {
            $genre = new Genre();
            $genre->setName($faker->word(2, true));

            $arrayGenre [] = $genre;

            $manager->persist($genre);
        }

        for($i = 1; $i <= 5; $i++) {
            $mode = new Mode();
            $mode->setName($faker->word());

            $arrayMode [] = $mode;

            $manager->persist($mode);
        }

        for($i = 1; $i <= 5; $i++) {
            $platform = new Platform();
            $platform->setName($faker->word());

            $arrayPlatform [] = $platform;

            $manager->persist($platform);
        }

        for($i = 1; $i <= 5; $i++) {
            $publisher = new Publisher();
            $publisher->setName($faker->company());

            $arrayPublisher [] = $publisher;

            $manager->persist($publisher);
        }

        for($i = 1; $i <= 5; $i++) {
            $region = new Region();
            $region->setName($faker->country());

            $arrayRegion [] = $region;

            $manager->persist($region);
        }

        // for($i = 1; $i <= 10; $i++) {
        //     $member = new Member();
        //     $role = new Role();
        //     $role = $role->setId(3);
        //     $role = $role->getId();dump($role);
        //     $member->setRole($role);
        //     $member->setNickName($faker->userName());
        //     $member->setMail($faker->email);
        //     $member->setInscriptionDate(new \Datetime());
        //     $member->setPassword($faker->password());

        //     $manager->persist($member);
        // }

        

        for ($i = 0; $i <= 10; $i++) {
            $game = new Game();
            $game->setName('Jeu N° ' . $i);
            $game->setContent($faker->paragraph(7));
            $game->setcoverExtension('jpg');

            $developer = $arrayDeveloper[array_rand($arrayDeveloper)];
            $game->addDeveloper($developer);

            $genre = $arrayGenre[array_rand($arrayGenre)];
            $game->addGenre($genre);

            $mode = $arrayMode[array_rand($arrayMode)];
            $game->addMode($mode);
            
            $manager->persist($game);

            for ($j = 1; $j <= mt_rand(1, 3); $j++) {
                $releaseDate = new ReleaseDate();
                $releaseDate->setGame($game);

                $platform = $arrayPlatform[array_rand($arrayPlatform)];
                $releaseDate->setPlatform($platform);

                $publisher = $arrayPublisher[array_rand($arrayPublisher)];
                $releaseDate->setPublisher($publisher);

                $region = $arrayRegion[array_rand($arrayRegion)];
                $releaseDate->setRegion($region);

                $releaseDate->setDate(\DateTime::createFromFormat('Y-m-d', $faker->date()));

                $manager->persist($releaseDate);

            }
        }

        $manager->flush();
    }
}