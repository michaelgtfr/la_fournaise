<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/07/2021
 * Time: 16:33
 */

namespace App\Tests\Behat;


use App\Entity\Location;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/07/2021
 * Time: 16:13
 */

class FeaturesContext extends MinkContext implements Context
{
    private $em;

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->em = $this->kernel->getContainer()->get('doctrine');
    }

    /**
     * @BeforeSuite
     */
    public static function beforeSuite()
    {
        StaticDriver::setKeepStaticConnections(true);
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        StaticDriver::beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        StaticDriver::rollBack();
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        StaticDriver::setKeepStaticConnections(false);
    }

    public function locationData()
    {
        $location = new Location();
        $location->setDay(1);
        $location->setAddress('testAddress');
        $location->setCity('testCity');
        $location->setBeginHour(new \DateTime());
        $location->setEndTime(new \DateTime());

        $manager = $this->em->getManager();
        $manager->persist($location);
        $manager->flush();
    }

    /**
     * @When I visit the web site
     */
    public function iVisitTheWebSite()
    {
        $this->locationData();
        $this->iAmOnHomepage();
    }

}