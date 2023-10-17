<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Cars
        for ($i = 1; $i <= 25; $i++) {
            $car = new Car();
            $car->setBrand($this->faker->word())
                ->setModel($this->faker->word())
                ->setYear(mt_rand(2000, 2023))
                ->setEnergy($this->faker->word())
                ->setKilometers(mt_rand(100, 300000))
                ->setPrice(mt_rand(1000, 100000));

            $manager->persist($car);
        }

        // Users
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $manager->persist($user);

        }

        $manager->flush();
    }
}
