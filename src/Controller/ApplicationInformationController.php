<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 08/11/2021
 * Time: 14:38
 */

namespace App\Controller;


use App\Entity\ApplicationInformation;
use App\Form\ApplicationInformationForm;
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

class ApplicationInformationController
{
    /**
     * @Route("/updateInformationApplicationProfile/{id}", name="app_update_information_application")
     * @ParamConverter("ApplicationInformation", options={"mapping": {"id": "id"}})
     * @param ApplicationInformation $applicationInformation
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     * @param UrlGeneratorInterface $generator
     * @return RedirectResponse
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function updateProfile(ApplicationInformation $applicationInformation, EntityManagerInterface $em,
                                  Session $session, Environment $twig, FormFactoryInterface $formFactory,
                                  Request $request, UrlGeneratorInterface $generator)
    {
        $applicationInformationForm = $formFactory->create(ApplicationInformationForm::class, $applicationInformation);

        $applicationInformationForm->handleRequest($request);
        if ($applicationInformationForm->isSubmitted() && $applicationInformationForm->isValid()) {
            $applicationInformation = $applicationInformationForm->getData();
            $em->persist($applicationInformation);
            $em->flush();

            $session->getFlashBag()->add(
                'success',
                'Votre modification à été prise en compte.'
            );
            $router = $generator->generate('app_dashboard_admin');
            return new RedirectResponse($router, 302);
        }

        $render = $twig->render("applicationInformationForm.html.twig", [
            'applicationInformationForm' => $applicationInformationForm->createView()
        ]);
        return new Response($render);
    }
}