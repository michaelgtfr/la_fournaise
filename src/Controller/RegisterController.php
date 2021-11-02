<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterForm;
use App\Treatment\RegisterTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class RegisterController
{
    /**
     * @Route("/register", name="register")
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param RegisterTreatment $registerTreatment
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(Environment $twig, FormFactoryInterface $formFactory, Request $request, MailerInterface $mailer,
                            EntityManagerInterface $em, Session $session, RegisterTreatment $registerTreatment,
                          UserPasswordEncoderInterface $passwordEncoder): Response
    {
       $user = new User();

       $registerForm = $formFactory->create(RegisterForm::class, $user);

       $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $user = $registerForm->getData();
            $registerTreatment->treatmentAndSendMailer(
                $user,
                $mailer,
                $em,
                $passwordEncoder,
                $session,
                $request->headers->get('host')
            );
        }

        $render = $twig->render('register.html.twig', [
            'form' => $registerForm->createView(),
        ]);
        return new Response($render);
    }
}
