<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 08/11/2021
 * Time: 16:11
 */

namespace App\Controller;


use App\Form\UserAgainstPasswordForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;


class UpdateClientProfileController
{
    /**
     * @Route("/profile/updateProfile", name="app_update_client_profile")
     * @param Security $security
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     * @param Session $session
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @param UrlGeneratorInterface $generator
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function updateClientProfile(Security $security, FormFactoryInterface $formFactory, Request $request,
                                        Session $session, EntityManagerInterface $em, Environment $twig,
                                        UrlGeneratorInterface $generator)
    {
        $userForm = $formFactory->create(UserAgainstPasswordForm::class, $security->getUser());

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user = $userForm->getData();
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add(
                'success',
                'Votre modification à été prise en compte.'
            );
            $router = $generator->generate('app_dashboard_client');
            return new RedirectResponse($router, 302);
        }

        $render = $twig->render("updateClientProfile.html.twig", [
            'userForm' => $userForm->createView()
        ]);
        return new Response($render);
    }
}