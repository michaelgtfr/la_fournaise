<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/11/2021
 * Time: 10:56
 */

namespace App\Treatment;


use App\Entity\Product;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;

class ProductTreatment
{

    public function pictureProductTreatment(Product $product, EntityManagerInterface $em, $menuForm)
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
            $product->getPictures()->getExtensionPicture(),
            $em
        );

        $nameElement = pathinfo($nameChangedPicture);

        $product->getPictures()->setNamePicture(strval($nameElement['filename']));
        $product->getPictures()->setExtensionPicture(strval($nameElement['extension']));
        $product->getPictures()->setDescriptionPicture(strval("photo du ". $product->getName()));

        return $product;
    }
}