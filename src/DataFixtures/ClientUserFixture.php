<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/10/2021
 * Time: 10:09
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientUserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('nameTest');
        $user->setNameOrderWithdrawal('nameTest');
        $user->setPassword($this->encoder->encodePassword($user,'1'));
        $user->setEmail('test_email@gmail.com');
        $user->setNumberCellphone('0700000000');
        $user->setConfirmationAccount(1);
        $user->setConfirmationKey(1);
        $user->setRoles([
            "ROLE_USER"
        ]);

        $this->setReference('clientUserId', $user);

        $manager->persist($user);

        $manager->flush();
    }
}