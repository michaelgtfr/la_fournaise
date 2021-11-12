<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/08/2021
 * Time: 16:44
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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
            "ROLE_ADMIN"
        ]);

        $manager->persist($user);
        $manager->flush();
    }
}