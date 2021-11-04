<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/08/2021
 * Time: 20:17
 */

namespace App\DataFixtures;


use App\Entity\ApplicationInformation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ApplicationInformationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $applicationInformation = new ApplicationInformation();
        $applicationInformation->setPhoneNumberApplication(0700000000);
        $applicationInformation->setFacebookApplication('facebook/test');
        $applicationInformation->setEmailApplication('email_test@gmail.com');

        $manager->persist($applicationInformation);
        $manager->flush();
    }
}