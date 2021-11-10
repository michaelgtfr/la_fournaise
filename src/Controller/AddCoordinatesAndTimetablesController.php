<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 02/11/2021
 * Time: 17:00
 */

namespace App\Controller;


use App\Entity\Location;
use App\Form\LocationForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddCoordinatesAndTimetablesController
{
    /**
     * @Route("/admin/addCoordinatesAndTimetables", name="app_add_coordinates_timetables")
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function addCoordinatesAndTimetables(FormFactoryInterface $formFactory, Request $request, Environment $twig,
                                                EntityManagerInterface $em, Session $session, UrlGeneratorInterface $generator)
    {
        $location = new Location();

        $locationForm = $formFactory->create(LocationForm::class, $location);

        $locationForm->handleRequest($request);
        if ($locationForm->isSubmitted() && $locationForm->isValid()) {
            $location = $locationForm->getData();
            $em->persist($location);
            $em->flush();

            $session->getFlashBag()->add(
                'success',
                'Votre nouvelle localisation à été enregistré.'
            );
            $router = $generator->generate('app_admin_coordinates_and_timetables');
            return new RedirectResponse($router, 302);
        }

        $render = $twig->render('updateCoordinatesAndTimetables.html.twig', [
            'locationForm' => $locationForm->createView(),
        ]);
        return new Response($render);
    }

}