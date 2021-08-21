<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/08/2021
 * Time: 00:17
 */

namespace App\Tests\Controller;


use App\DataFixtures\ProductFixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\Panther\PantherTestCase;

class ListOfProductControllerTest extends PantherTestCase
{
    use FixturesTrait;

    protected function dataFixture()
    {
        $this->loadFixtures([
            ProductFixture::class,
        ]);
    }

    public function tearDown(): void
    {
        $purger = new ORMPurger(self::$container->get('doctrine')->getManager());
        $purger->purge();
        parent::tearDown();
    }

    public function testListOfProductDisplayPage()
    {
        $client = static::createPantherClient([
        ]);

        $this->dataFixture();

        $client->request('GET', '/listofproduct');

        //display the page
        $this->assertSelectorTextContains('h4','Le menu:');

        //display the data
        $this->assertSelectorTextContains('h6', 'nameProduct');

        //operation the js
        $this->assertSelectorIsVisible('.subtitle_1');

        $this->assertSelectorIsNotVisible('.subtitle_2');
    }

}