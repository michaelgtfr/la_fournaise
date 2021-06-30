<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 06/06/2021
 * Time: 15:05
 */

namespace App\Controller;


use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class homepageController
{
    /**
     * @Route("/", name="app_homepage")
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function homepage(EntityManagerInterface $em, Environment $twig)
    {
        $locations = $em->getRepository(Location::class)->findAll();

        $render = $twig->render('homepage.html.twig', [
            'locations' => $locations,
        ]);
        return new Response($render);
    }
}