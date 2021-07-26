<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/07/2021
 * Time: 01:13
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\Panther\PantherTestCase;

class HomepageControllerTest extends PantherTestCase
{
    use FixturesTrait;

    protected function dataFixture()
    {
        $this->loadFixtures([
            AppFixtures::class,
        ]);
    }

    public function tearDown(): void
    {
        $purger = new ORMPurger(self::$container->get('doctrine')->getManager());
        $purger->purge();
        parent::tearDown();

    }

    public function testHomepageDisplayPage()
    {
        $client = static::createPantherClient();
        $this->dataFixture();

        $client->request('GET', '/');

        $this->assertSelectorTextContains('.location__title', 'Localisations/Horaires:');

        //display of cards
        $this->assertSelectorTextContains('.card-title', 'Lundi');

        //display of marker
        $this->assertSelectorIsVisible('.leaflet-marker-pane');
    }
}