<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 02/11/2021
 * Time: 16:42
 */

namespace App\Controller;


use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteCoordinatesAndTimetablesController
{
    /**
     * @Route("/admin/deleteCoordinatesAndUpdate/{id}", name="app_delete_coordinates_timetables")
     * @ParamConverter("location", options={"mapping": {"id": "id"}})
     * @param Location $location
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @return RedirectResponse
     */
    public function deleteCoordinatesAndTimetables(Location $location, EntityManagerInterface $em, Session $session,
                                                   UrlGeneratorInterface $generator)
    {
        $em->remove($location);
        $em->flush();

        $session->getFlashBag()->add(
            'success',
            'Vos coordonnées ont été effacé.'
        );

        $router = $generator->generate('app_admin_coordinates_and_timetables');
        return new RedirectResponse($router, 302);
    }
}