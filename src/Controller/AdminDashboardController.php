<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 17/08/2021
 * Time: 16:58
 */

namespace App\Controller;


use App\Entity\ApplicationInformation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminDashboardController
{
    /**
     * @Route("/admin/dashboardadmin", name="app_dashboard_admin")
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function adminDashboard(EntityManagerInterface $em, Environment $twig)
    {
        $applicationInformation = $em->getRepository(ApplicationInformation::class)->findAll();

        $render = $twig->render('adminDashboard.html.twig', [
            'applicationInformation' => $applicationInformation[0],
        ]);

        return new Response($render);
    }
}