<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Availability;
use AppBundle\Entity\Diary;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadData extends Fixture
{
    /** @var ContainerInterface */
    public $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //Availabilities
        $time = new \DateTime();
        $availabilities = [];

        for ($i = 0; $i < 200; $i++) {
            $minutes_to_add = 30;

            $availability = new Availability();

            $availability
                ->setDate(new \DateTime())
                ->setTime(new \DateTime());

            $time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));

            array_push($availabilities, $availability);

            $manager->persist($availability);
            $manager->flush();
        }

        //User1 and Diary 1
        $user = new User();
        $user
            ->setFirstName('Bugs')
            ->setLastName('Bunny')
            ->setIdCard('2345678A')
            ->setEmail('bugs@bunny.com')
            ->setPhone('123456789')
            ->setCountry('Spain');

        $diary1 = new Diary();
        $diary1
            ->setDescription('Diary 1 of ' . $user->getFirstName())
            ->setUser($user)
            ->setAvailability($availabilities[0]);

        $diary2 = new Diary();
        $diary2
            ->setDescription('Diary 2 of ' . $user->getFirstName())
            ->setUser($user)
            ->setAvailability($availabilities[sizeof($availabilities) - 1 ]);

        $manager->persist($user);
        $manager->persist($diary1);
        $manager->persist($diary2);
        $manager->flush();

        //User and Diary 2
        $user = new User();
        $user
            ->setFirstName('Daffy')
            ->setLastName('Duck')
            ->setIdCard('2345678B')
            ->setEmail('daffy@duck.com')
            ->setPhone('123456781')
            ->setCountry('Spain');

        $diary = new Diary();
        $diary
            ->setDescription('Diary of ' . $user->getFirstName())
            ->setUser($user)
            ->setAvailability($availabilities[1]);

        $manager->persist($user);
        $manager->persist($diary);
        $manager->flush();
    }
}