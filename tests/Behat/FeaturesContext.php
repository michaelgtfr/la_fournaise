<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/07/2021
 * Time: 16:33
 */

namespace App\Tests\Behat;


use App\Entity\ApplicationInformation;
use App\Entity\Location;
use App\Entity\PictureProduct;
use App\Entity\Product;
use App\Entity\User;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    private $encoder;

    public function __construct(KernelInterface $kernel, \Behat\Mink\Session $session, UserPasswordEncoderInterface $encoder)
    {
        $this->kernel = $kernel;
        $this->em = $this->kernel->getContainer()->get('doctrine');
        $this->session = $session;
        $this->encoder = $encoder;
    }

    /**
     * @BeforeSuite
     */
    public static function beforeSuite()
    {
        StaticDriver::setKeepStaticConnections(false);
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        $this->locationData();
        StaticDriver::beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        StaticDriver::rollBack();
        $this->purger();
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
        for ($i = 0; $i<=6; $i++) {
            $location = new Location();
            $location->setDay($i);
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
    }

    public function purger()
    {
        $purger = new ORMPurger($this->em->getManager());
        $purger->purge();
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

    /**
     * @Given I want see the menu
     */
    public function iWantSeeTheMenu()
    {
        $product = new product();
        $product->setName('name product');
        $product->setIngredientList('ingredient product');
        $product->setPresentation('presentation product');
        $product->setPrice(1);
        $product->setTypeOfProduct(1);
        $product->setStatus(1);


        $picture = new PictureProduct();
        $picture->setNamePicture('namePicture');
        $picture->setExtensionPicture('jpg');
        $picture->setDescriptionPicture('description picture');

        $product->setPictures($picture);
        $manager = $this->em->getManager();
        $manager->persist($product);
        $manager->flush();
    }

    /**
     * @When I go further down the page
     */
    public function iGoFurtherDownThePage()
    {
        $this->getSession()->executeScript("scroll(0,300);");
        $this->getSession()->wait(5000);
    }

    /**
    * @Given I am logged in as an admin
    */
    public function iAmLoggedInAsAnAdmin()
    {
        $this->adminUserdata('admin', 'admin');
        $this->applicationInformationData();

        $this->visitPath('/login');
        $this->fillField('email', 'admin');
        $this->fillField('password', 'admin');
        $this->pressButton('Valider');
    }

    public function adminUserdata($email, $password)
    {
        $user = new User();
        $user->setName('nameTest');
        $user->setNameOrderWithdrawal('nameTest');
        $user->setNumberCellphone(0700000000);
        $user->setConfirmationKey(1);
        $user->setConfirmationAccount(1);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setRoles(array('ROLE_ADMIN'));
        $em = $this->em->getManager();
        $em->persist($user);
        $em->flush();
    }

    public function applicationInformationData()
    {
        $applicationInformation = new ApplicationInformation();
        $applicationInformation->setEmailApplication('email_test@gmail.com');
        $applicationInformation->setFacebookApplication('facebooktest');
        $applicationInformation->setPhoneNumberApplication(0700000000);

        $em = $this->em->getManager();
        $em->persist($applicationInformation);
        $em->flush();
    }
}