<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 23/08/2021
 * Time: 19:59
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactForm;
use App\Treatment\ContactTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController
{
    /**
     * @Route("/contact", name="app_contact")
     * @param Request $request
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param ContactTreatment $contactTreatment
     * @param Session $session
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function contact(Request $request, Environment $twig, FormFactoryInterface $formFactory,
                            ContactTreatment $contactTreatment, Session $session, MailerInterface $mailer,
                            EntityManagerInterface $em)
    {
        $contact = new Contact();
        $form = $formFactory->create(ContactForm::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $validationTreatment = $contactTreatment->treatmentAndSendMailer($contact, $mailer, $em);

            if($validationTreatment) {
                $session->getFlashBag()->add(
                    'success',
                    'Votre email à été envoyé.'
                );
            } else {
                $session->getFlashBag()->add(
                    'error',
                    'Désolé, mais une erreur est survenu pendant l\'envoi. vous pouvez ré-essayer en remplissant ce formulaire'
                );
            }
        }

        $render = $twig->render('contactForm.html.twig', [
            'form' => $form->createView(),
        ]);
        return new Response($render);
    }
}
