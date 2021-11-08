<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/11/2021
 * Time: 10:56
 */

namespace App\Treatment;


use App\Entity\PictureProduct;
use App\Entity\Product;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;

class ProductTreatment
{

    public function updatePictureProductTreatment(Product $product, $menuForm)
    {
        $processsingFile = new ProcessingFiles();

        //setting up the picture in the imgProduct folder
        $nameChangedPicture = $processsingFile->processingFiles(
            $product->getUploadFile(),
            $menuForm->get('uploadFile')->getData()->guessExtension(),
            'imgProduct'
        );

        //delete the old picture in the imgProduct folder
        $processsingFile->deletePictureProduct('imgProduct',
            $product->getPictures()->getNamePicture(),
            $product->getPictures()->getExtensionPicture()
        );

        $nameElement = pathinfo($nameChangedPicture);

        $product->getPictures()->setNamePicture(strval($nameElement['filename']));
        $product->getPictures()->setExtensionPicture(strval($nameElement['extension']));
        $product->getPictures()->setDescriptionPicture(strval("photo du ". $product->getName()));

        return $product;
    }

    public function createPictureProductTreatment(Product $product, $productForm)
    {
        $processingPicture = new ProcessingFiles();
        $nameChangedPicture = $processingPicture->processingFiles(
            $product->getUploadFile(),
            $productForm->get('uploadFile')->getData()->guessExtension(),
            'imgProduct'
        );

        $nameElement = pathinfo($nameChangedPicture);

        $picture = new PictureProduct();
        $product->setPictures($picture);
        $product->getPictures()->setNamePicture(strval($nameElement['filename']));
        $product->getPictures()->setExtensionPicture(strval($nameElement['extension']));
        $product->getPictures()->setDescriptionPicture(strval("photo du ". $product->getName()));

        return $product;
    }
}