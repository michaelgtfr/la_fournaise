<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 21/08/2021
 * Time: 17:47
 */

namespace App\Controller;


use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CoordinatesAndTimetablesController
{
    /**
     * @Route("/admin/coordonneesethoraires", name="app_admin_coordinates_and_timetables")
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function coordinatesAndTimeTable(EntityManagerInterface $em, Environment $twig)
    {
        $locations = $em->getRepository(Location::class)->findAll();

        $render = $twig->render('coordinatesAndTimetables.html.twig', [
            'locations' => $locations,
        ]);

        return new Response($render);
    }
}