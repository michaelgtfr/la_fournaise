<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 02/08/2021
 * Time: 11:14
 */

namespace App\Controller;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ListOfProductController
{
    /**
     * @Route("/listofproduct", "app_list_of_product")
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function listOfProduct(EntityManagerInterface $em, Environment $twig)
    {
        $listOfProduct = $em->getRepository(Product::class)->findAll();

        $render = $twig->render('listOfProduct.html.twig', [
            'listOfProduct' => $listOfProduct,
        ]);

        return new Response($render);
    }
}