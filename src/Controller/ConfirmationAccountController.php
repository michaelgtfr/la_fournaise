<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 02/11/2021
 * Time: 12:44
 */

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ConfirmationAccountController
{
    /**
     * @Route("/confirmation", name="app_account_confirmation")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @return RedirectResponse
     */
    public function confirmationAccount(Request $request, EntityManagerInterface $em, Session $session,
                    UrlGeneratorInterface $generator)
    {
        $email = $request->get('email');
        $key = $request->get('key');

        if (!$key || !$email) {
            $session->getFlashBag()->add(
                'error',
                'désoler, mais une erreur est survenu, veuillez réessayer ou contacter un administrateur 
                via le formulaire de contact.'
            );
            $router = $generator->generate('app_homepage');
            return new RedirectResponse($router, 302);
        }

        $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user->getId()) {
            $session->getFlashBag()->add(
                'error',
                'désoler mais une erreur est survenu, veuillez vous réinscrire sur le site.'
            );
            $router = $generator->generate('app_homepage');
            return new RedirectResponse($router, 302);
        }

        $user->setConfirmationAccount(1);
        $em->persist($user);
        $em->flush();

        $session->getFlashBag()->add(
            'success',
            'Votre compte à été activé vous pouvez dès à présent vous connectez à votre compte '
        );
        $router = $generator->generate('app_homepage');
        return new RedirectResponse($router, 302);
    }
}