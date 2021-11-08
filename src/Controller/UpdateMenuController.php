<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/11/2021
 * Time: 15:23
 */

namespace App\Controller;


use App\Entity\PictureProduct;
use App\Entity\Product;
use App\Form\ProductForm;
use App\Service\ProcessingFiles;
use App\Treatment\ProductTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UpdateMenuController
{
    /**
     * @Route("/admin/updatemenu/{id}", name="app_update_menu")
     * @ParamConverter("Product", options={"mapping": {"id": "id"}})
     * @param Product $product
     * @param Environment $twig
     * @param Session $session
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $generator
     * @return RedirectResponse
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function updateMenu(Product $product, Environment $twig, Session $session, FormFactoryInterface $formFactory,
                               Request $request, EntityManagerInterface $em, UrlGeneratorInterface $generator)
    {
        $menuForm = $formFactory->create(ProductForm::class, $product);

        $menuForm->handleRequest($request);
        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
            $product = $menuForm->getData();

            if ($product->getUploadFile()) {
                $productTreatment = new ProductTreatment();
                $product = $productTreatment->updatePictureProductTreatment(
                    $product,
                    $menuForm
                );
            }

            $em->persist($product);
            $em->flush();

            $session->getFlashBag()->add(
                'success',
                'Votre modification à été prise en compte.'
            );
            $router = $generator->generate('app_list_of_product');
            return new RedirectResponse($router, 302);
        }

        $render = $twig->render('formMenu.html.twig', [
            'productForm' => $menuForm->createView(),
            'picture' => $product->getPictures(),
        ]);

        return new Response($render);
    }
}