<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 09:20
 */

namespace App\Tests\Entity;


use App\Entity\DetailOrder;
use App\Entity\Order;
use App\Entity\Product;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class DetailOrderTest extends TestCase
{
    public function testDetailOrderEntityWithCorrectData()
    {
        $data = [
            'quantity' => 2,
        ];

        $order = new Order();
        $product = new Product();

        $detailOrder = new DetailOrder();
        $detailOrder->setQuantity($data['quantity']);
        $detailOrder->setOrders($order);
        $detailOrder->setProducts($product);

        $this->assertEquals(null, $detailOrder->getId());
        $this->assertEquals($data['quantity'], $detailOrder->getQuantity());
        $this->assertEquals($order, $detailOrder->getOrders());
        $this->assertEquals($product, $detailOrder->getProducts());
    }

    public function testDetailOrderEntityWithBadDataLengthPart()
    {
        $data = [
            'quantity' => str_pad(1, 3, "1", STR_PAD_BOTH),
        ];

        $detailOrder = new DetailOrder();
        $detailOrder->setQuantity($data['quantity']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($detailOrder);

        $this->assertEquals(1, count($errors));
    }

    public function testDetailOrderEntityWithBadDataExceptionPartOnTheOrdersRelationAttribute()
    {
        $data = [
            'order' => [],
        ];

        $this->expectException(Error::class);
        $detailOrder = new DetailOrder();
        $detailOrder->setOrders($data['order']);
    }
}
