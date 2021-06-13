<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 10:48
 */

namespace App\Tests\Entity;


use App\Entity\DetailOrder;
use App\Entity\PictureProduct;
use App\Entity\Product;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ProductTest extends TestCase
{
    public function testProductEntityWithCorrectData()
    {
        $data = [
            'presentation' => 'presentationTest',
            'price' => 2,
            'status' => 1,
            'name' => 'nameTest',
            'ingredientList' => 'ingredientListTest',
        ];

        $detailOrder = new DetailOrder();
        $picture = new PictureProduct();

        $product = new Product();
        $product->setPresentation($data['presentation']);
        $product->setPrice($data['price']);
        $product->setStatus($data['status']);
        $product->setName($data['name']);
        $product->setIngredientList($data['ingredientList']);
        $product->addDetailOrder($detailOrder);
        $product->setPictures($picture);

        $this->assertEquals(null, $product->getId());
        $this->assertEquals($data['presentation'], $product->getPresentation());
        $this->assertEquals($data['price'], $product->getPrice());
        $this->assertEquals($data['status'], $product->getStatus());
        $this->assertEquals($data['name'], $product->getName());
        $this->assertEquals($data['ingredientList'], $product->getIngredientList());
        $this->assertContains($detailOrder, $product->getDetailOrders());
        $this->assertEquals($picture, $product->getPictures());

        $product->removeDetailOrder($detailOrder);
        $this->assertNotContains($detailOrder, $product->getDetailOrders());
    }

    public function testProductEntityWithBadDataLengthPart()
    {
        $data = [
            'presentation' => str_pad(1, 256, "1", STR_PAD_BOTH),
            'price' => str_pad(1, 4, "1", STR_PAD_BOTH),
            'status' => str_pad(1, 2, "1", STR_PAD_BOTH),
            'name' => str_pad(1, 101, "1", STR_PAD_BOTH),
            'ingredientList' => str_pad(1, 101, "1", STR_PAD_BOTH),
        ];

        $product = new Product();
        $product->setPresentation($data['presentation']);
        $product->setPrice($data['price']);
        $product->setStatus($data['status']);
        $product->setName($data['name']);
        $product->setIngredientList($data['ingredientList']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($product);

        $this->assertEquals(5, count($errors));
    }

    public function testProductEntityWithBadDataNoBankPart()
    {
        $product = new Product();

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($product);

        $this->assertEquals(2, count($errors));
    }

    public function testProductEntityWithBadDataExceptionPartOnTheDetailOrderRelationAttribute()
    {
        $data = [
            'detailOrder' => [],
        ];

        $this->expectException(Error::class);
        $product = new Product();
        $product->addDetailOrder($data['detailOrder']);
    }
}
