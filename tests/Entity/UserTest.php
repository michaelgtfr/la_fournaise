<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 27/05/2021
 * Time: 06:52
 */

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\User;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    public function testUserEntityWithCorrectData()
    {
        $data = [
            'email' => 'test@gmail.com',
            'roles' => ['ROLE_USER'],
            'password' => 'passwordTest',
            'name' => 'nameTest',
            'numberCellphone' => '0181367683',
            'confirmationAccount' => 1,
            'confirmationKey' => '2534651dfdsf'
        ];

        $order = new Order();

        $user = new User();
        $user->setEmail($data['email']);
        $user->setRoles($data['roles']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setNameOrderWithdrawal($data['name']);
        $user->setNumberCellphone($data['numberCellphone']);
        $user->setConfirmationAccount($data['confirmationAccount']);
        $user->setConfirmationKey($data['confirmationKey']);
        $user->setConfirmationPassword($data['password']);
        $user->addOrder($order);

        $this->assertEquals(null, $user->getId());
        $this->assertEquals($data['email'], $user->getEmail());
        $this->assertEquals($data['roles'], $user->getRoles());
        $this->assertEquals($data['password'], $user->getPassword());
        $this->assertEquals($data['name'], $user->getName());
        $this->assertEquals($data['email'], $user->getUsername());
        $this->assertEquals($data['name'], $user->getNameOrderWithdrawal());
        $this->assertEquals($data['numberCellphone'], $user->getNumberCellphone());
        $this->assertEquals($data['confirmationAccount'], $user->getConfirmationAccount());
        $this->assertEquals($data['confirmationKey'], $user->getConfirmationKey());
        $this->assertEquals($data['password'], $user->getConfirmationPassword());
        $this->assertContains($order, $user->getOrders());

        $user->removeOrder($order);
        $this->assertNotContains($order, $user->getOrders());

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($user);

        $this->assertEquals(0, count($errors));
    }

    public function testUserEntityWithBadDataLengthPart()
    {
        $data = [
            'password' => str_pad(1, 256, "1", STR_PAD_BOTH),
            'name' => str_pad(1, 41, "1", STR_PAD_BOTH),
            'numberCellphone' => str_pad(1, 11, "1", STR_PAD_BOTH),
            'confirmationKey' => str_pad(1, 256, "1", STR_PAD_BOTH),
        ];

        $user = new User();
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setNameOrderWithdrawal($data['name']);
        $user->setNumberCellphone($data['numberCellphone']);
        $user->setConfirmationKey($data['confirmationKey']);
        $user->setConfirmationPassword($data['password']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($user);

        $this->assertEquals(6, count($errors));
    }

    public function testUserEntityWithBadDataTypePart()
    {
        $data = [
            'email' => 'test',
        ];

        $user = new User();
        $user->setEmail($data['email']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($user);

        $this->assertEquals(1, count($errors));
    }

    public function testUserEntityWithBadDataExceptionPartOnTheEmailAttribute()
    {
        $data = [
            'email' => [],
        ];

        $this->expectException(Error::class);
        $user = new User();
        $user->setEmail($data['email']);
    }

    public function testUserEntityWithBadDataExceptionPartOnTheOrderRelationAttribute()
    {
        $data = [
            'order' => [],
        ];

        $this->expectException(Error::class);
        $user = new User();
        $user->addOrder($data['order']);
    }
}
