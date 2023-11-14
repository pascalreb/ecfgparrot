<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\Hour;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Contact;
use App\Entity\Opinion;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
        for ($i = 0; $i < 5; $i++) {
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
        $users = [];

        $admin = new User();
        $admin->setEmail('admin@garageparrot.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('admin');

        $users[] = $admin;
        $manager->persist($admin);

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $manager->persist($user);
        }

        // Opinions
        for ($i = 0; $i < 20; $i++) {
            $opinion = new Opinion();
            $opinion->setName($this->faker->name())
                ->setMessage($this->faker->text(100))
                ->setMark(mt_rand(1, 5))
                ->setIsApproved(mt_rand(0, 1) == 1 ? true : false);

            $manager->persist($opinion);
        }

        // Contact
        for ($i = 0; $i < 5; $i++) {
            $contact = new Contact();
            $contact->setSubject($this->faker->text(100))
                ->setName($this->faker->name())
                ->setFirstname($this->faker->name())
                ->setEmail($this->faker->email())
                ->setPhone('0' . mt_rand(100000000, 599999999))
                ->setMessage($this->faker->text());

            $manager->persist($contact);
        }

        // Hours
        // for ($i = 0; $i < 6; $i++) {
        //     $hour = new Hour();
        //     $hour->setDay($this->faker->dayOfWeek())
        //         ->setOpeningTime1($this->faker->time())
        //         ->setClosingTime1($this->faker->time())
        //         ->setOpeningTime2($this->faker->time())
        //         ->setClosingTime2($this->faker->time());

        //     $manager->persist($hour);
        // }

        $manager->flush();
    }
}
