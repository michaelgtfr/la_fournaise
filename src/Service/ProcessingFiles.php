<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/11/2021
 * Time: 06:46
 */

namespace App\Service;


use App\Entity\PictureProduct;
use Doctrine\ORM\EntityManagerInterface;

class ProcessingFiles
{
    /**
     * Move the image to the img Avatar folder and change its name, protection against the fault UPLOAD
     * @param $linkFile
     * @param $extensionFile
     * @param $folder
     * @return string
     */
    public function processingFiles($linkFile, $extensionFile, $folder)
    {
        //creation of the new name
        $datePicture = date('Y_m_d_H_i_s');
        $idUnique = uniqid();
        $namePhoto = "{$datePicture}-{$idUnique}.{$extensionFile}";

        //transfer
        $transferFile ="img/$folder/$namePhoto";
        move_uploaded_file($linkFile, $transferFile);

        return $namePhoto;
    }

    /**
     * Delete the file in the img folder and the bdd
     * @param $folder
     * @param $name
     * @param $extension
     */
    public function deletePictureProduct($folder , $name, $extension)
    {
        unlink('img/'.$folder.'/'.$name.'.'.$extension);
    }
}