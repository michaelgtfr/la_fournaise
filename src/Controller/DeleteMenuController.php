<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/11/2021
 * Time: 15:36
 */

namespace App\Controller;


use App\Entity\Product;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteMenuController
{
    /**
     * @Route("/admin/deletemenu/{id}", name="app_delete_menu")
     * @ParamConverter("Product", options={"mapping": {"id": "id"}})
     * @param Product $product
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function deleteMenu(Product $product, Session $session, UrlGeneratorInterface $generator,
                               EntityManagerInterface $em)
    {
        //delete the picture of the product in the imgProduct folder
        $deletePicture = new ProcessingFiles();
        $deletePicture->deletePictureProduct('imgProduct',
            $product->getPictures()->getNamePicture(),
            $product->getPictures()->getExtensionPicture()
        );

        //delete the product
        $em->remove($product);
        $em->flush();



        $session->getFlashBag()->add(
            'success',
            'Votre menu ont été effacé.'
        );

        $router = $generator->generate('app_list_of_product');
        return new RedirectResponse($router, 302);
    }
}