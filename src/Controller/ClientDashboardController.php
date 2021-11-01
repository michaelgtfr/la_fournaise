<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/10/2021
 * Time: 08:22
 */

namespace App\Controller;


use App\Entity\Order;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ClientDashboardController
{
    /**
     * @Route("/profile/dasboardClient/{id}", name="app_dashboard_client")
     * @ParamConverter("user", options={"mapping": {"id": "id"}})
     * @param User $user
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function clientDashboard(User $user, EntityManagerInterface $em, Environment $twig)
    {
        $orders = $em->getRepository(Order::class)->findBy(['users' => $user->getId()]);


        $render = $twig->render('clientDashboard.html.twig', [
            'user' => $user,
            'orders' => $orders
        ]);

        return new Response($render);
    }
}