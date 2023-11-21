<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

        $actors = $faker->actors($gender = null, $count = 190, $duplicates = false);
        foreach ($actors as $item) {
            $fullName = $item;
            $fullNameExploded = explode(' ', $fullName);
            $firstname = $fullNameExploded[0];
            $lastname = $fullNameExploded[1];

            $actor = new Actor();
            $actor->setLastname($lastname);
            $actor->setFirstname($firstname);
            $actor->setDob($faker->dateTimeBetween('-80 years', '-20 years'));
            $actor->setCreatedAt(new \DateTimeImmutable());

            $createdActors[] = $actor;

            $manager->persist($actor);
        }

        $movies = $faker->movies(100);

        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setTitle($item);
            shuffle($createdActors);

            $createdActorsSliced = array_slice($createdActors, 0, 5);

            foreach ($createdActorsSliced as $actor) {
                $movie->addActor($actor);
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
