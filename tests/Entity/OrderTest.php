<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 11:58
 */

namespace App\Tests\Entity;


use App\Entity\DetailOrder;
use App\Entity\Order;
use App\Entity\User;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class OrderTest extends TestCase
{
    public function testOrderEntityWithCorrectData()
    {
        $data = [
            'totalPrice' => 5,
            'status' => 1,
            'dateOrder' => new \DateTime(),
        ];

        $user = new User();
        $detailOrder = new DetailOrder();

        $order = new Order();
        $order->setTotalPrice($data['totalPrice']);
        $order->setStatus($data['status']);
        $order->setDateOrder($data['dateOrder']);
        $order->setUsers($user);
        $order->addDetailOrder($detailOrder);

        $this->assertEquals(null, $order->getId());
        $this->assertEquals($data['totalPrice'], $order->getTotalPrice());
        $this->assertEquals($data['status'], $order->getStatus());
        $this->assertEquals($data['dateOrder'], $order->getDateOrder());
        $this->assertEquals($user, $order->getUsers());
        $this->assertContains($detailOrder, $order->getDetailOrders());

        $order->removeDetailOrder($detailOrder);

        $this->assertNotContains($detailOrder, $order->getDetailOrders());
    }

    public function testOrderEntityWithBadDataLengthPart()
    {
        $data = [
            'status' => str_pad(1, 2, "1", STR_PAD_BOTH),
        ];

        $order = new Order();
        $order->setStatus($data['status']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($order);

        $this->assertEquals(1, count($errors));
    }

    public function testOrderEntityWithBadDataExceptionPartOnTheDateOrderAttribute()
    {
        $data = [
            'dateOrder' => [],
        ];

        $this->expectException(Error::class);
        $order = new Order();
        $order->setDateOrder($data['dateOrder']);
    }

    public function testUserEntityWithBadDataExceptionPartOnTheOrderRelationAttribute()
    {
        $data = [
            'detailorder' => [],
        ];

        $this->expectException(Error::class);
        $order = new Order();
        $order->addDetailOrder($data['detailorder']);
    }
}
