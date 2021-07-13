<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/07/2021
 * Time: 01:13
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepageDisplayPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Localisations/Horaires:', $crawler->filter('.location__title')->text());
    }
}
