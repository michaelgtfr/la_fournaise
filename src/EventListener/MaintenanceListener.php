<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/11/2021
 * Time: 16:09
 */

namespace App\EventListener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

class MaintenanceListener
{
    private $container, $maintenance, $ipAuthorized;
    public function __construct($maintenance, ContainerInterface $container)
    {
        $this->container = $container;
        $this->maintenance = $maintenance["statut"];
        $this->ipAuthorized = $maintenance["ipAuthorized"];
    }
    public function onKernelRequest(RequestEvent $event)
    {
        // This will get the value of our maintenance parameter
        $maintenance = $this->maintenance ? $this->maintenance : false;
        $currentIP = $_SERVER['REMOTE_ADDR'];
        // This will detect if we are in dev environment (app_dev.php)
        // $debug = in_array($this->container->get('kernel')->getEnvironment(), ['dev']);
        // If maintenance is active and in prod environment
        if ($maintenance AND !in_array($currentIP, $this->ipAuthorized)) {
            // We load our maintenance template
            $filesystemLoader = new FilesystemLoader(__DIR__.'../../../templates/maintenance/%name%');

            $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);
            $templating->set(new SlotsHelper());

            $template = $templating->render('maintenance.html.twig');
            // We send our response with a 503 response code (service unavailable)
            $event->setResponse(new Response($template, 503));
            $event->stopPropagation();
        }
    }
}