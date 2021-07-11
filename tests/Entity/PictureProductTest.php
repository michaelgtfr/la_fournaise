<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 11:30
 */

namespace App\Tests\Entity;


use App\Entity\PictureProduct;
use App\Entity\Product;
use Error;
use PHPUnit\Framework\TestCase;

class PictureProductTest extends TestCase
{
    public function testPictureProductEntityWithCorrectData()
    {
        $product = new Product();

        $pictureProduct = new PictureProduct();
        $pictureProduct->setProducts($product);

        $this->assertEquals(null, $pictureProduct->getId());
        $this->assertEquals($product, $pictureProduct->getProducts());

        $pictureProduct->setProducts(null);

        $this->assertEquals(null, $pictureProduct->getProducts());
    }

    public function testPictureProductEntityWithBadDataExceptionPartOnTheProductsRelationAttribute()
    {
        $data = [
            'product' => [],
        ];

        $this->expectException(Error::class);
        $user = new PictureProduct();
        $user->setProducts($data['product']);
    }
}
