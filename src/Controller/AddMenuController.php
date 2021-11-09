<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 08/11/2021
 * Time: 06:50
 */

namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductForm;
use App\Treatment\ProductTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddMenuController
{
    /**
     * @Route("/addmenu", name="app_add_menu")
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $generator
     * @param Session $session
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function addMenu(Request $request, FormFactoryInterface $formFactory, Environment $twig,
                            EntityManagerInterface $em, UrlGeneratorInterface $generator, Session $session)
    {
        $product = new Product();

        $productForm = $formFactory->create(ProductForm::class, $product);

        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();

            if ($product->getUploadFile()) {
                $productTreatment = new ProductTreatment();
                $product = $productTreatment->createPictureProductTreatment(
                    $product,
                    $productForm
                );
            }
            $em->persist($product);
            $em->flush();

            $session->getFlashBag()->add(
                'success',
                'Votre ajout à été prise en compte.'
            );
            $router = $generator->generate('app_list_of_product');
            return new RedirectResponse($router, 302);
        }

        $render = $twig->render('formMenu.html.twig', [
            'productForm' => $productForm->createView(),
        ]);
        return new Response($render);
    }
}