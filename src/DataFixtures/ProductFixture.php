<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/08/2021
 * Time: 01:29
 */

namespace App\DataFixtures;


use App\Entity\PictureProduct;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $picture = new PictureProduct();

        $product->setName('nameProduct');
        $product->setStatus(1);
        $product->setIngredientList('ingredientTest');
        $product->setPrice(1);
        $product->setTypeOfProduct(1);
        $product->setPresentation('presentation test');

        $picture->setNamePicture('name_picture');
        $picture->setDescriptionPicture('description picture test');
        $picture->setExtensionPicture('jpg');

        $product->setPictures($picture);

        $manager->persist($product);

        $manager->flush();

    }
}
