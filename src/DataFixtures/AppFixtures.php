<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<=6; $i++) {
            $datetime = new \DateTime();
            $location = new Location();
            $location->setDay($i);
            $location->setAddress('test address');
            $location->setCity('test city');
            $location->setBeginHour($datetime);
            $location->setEndTime($datetime);
            $location->setLatitude(50.000);
            $location->setLongitude(1.6000);

            $manager->persist($location);

            $manager->flush();
        }
    }
}
