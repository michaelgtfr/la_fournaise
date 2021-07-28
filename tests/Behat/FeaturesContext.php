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
use function PHPUnit\Framework\assertEquals;
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

    /** @var \Behat\Mink\Session */
    private $session;

    private $verificationOfNumberMarkerDisplay;

    public function __construct(KernelInterface $kernel, \Behat\Mink\Session $session)
    {
        $this->kernel = $kernel;
        $this->em = $this->kernel->getContainer()->get('doctrine');
        $this->session = $session;
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
        $this->locationData();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        StaticDriver::rollBack();
        $this->session->restart();
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
        $location->setLatitude(50.000);
        $location->setLongitude(1.6000);

        $manager = $this->em->getManager();
        $manager->persist($location);
        $manager->flush();
    }

    /**
     * @When I visit the web site
     */
    public function iVisitTheWebSite()
    {
        $this->visit('/');
    }

    /**
     * @Then a marker
     */
    public function aMarker()
    {
        $this->assertResponseContains('leaflet-marker-icon');
    }

    /**
     * @When I click on the card
     */
    public function iClickOnTheCard()
    {
        $this->verificationOfNumberMarkerDisplay = $this->getSession()->evaluateScript("document.getElementById('mapid').dataset.numberMarkerTotalCall");
        $this->getSession()->executeScript("scroll(0,600);");
        $this->getSession()->executeScript("document.querySelector('.card-title').click();");
    }

    /**
     * @Then I should see the location of the day on the map
     */
    public function iShouldSeeTheLocationOfTheDayOnTheMap()
    {
        $this->getSession()->wait(5000);
        $this->assertResponseContains('leaflet-marker-icon');
        $verificationOfOperationOfCallMarker = $this->verificationOfNumberMarkerDisplay +1;
        $this->assertResponseContains('data-number-marker-total-call=\"' . $verificationOfOperationOfCallMarker .'\"');
    }
}