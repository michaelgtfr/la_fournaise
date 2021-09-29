<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 25/08/2021
 * Time: 18:46
 */

namespace App\Tests\Controller;


use App\DataFixtures\ApplicationInformationFixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $client;

    protected function dataFixture()
    {
        $this->loadFixtures([
            ApplicationInformationFixture::class
        ]);
    }

    public function tearDown(): void
    {
        $purger = new ORMPurger(self::$container->get('doctrine')->getManager());
        $purger->purge();
        parent::tearDown();
    }

    public function testDisplayContactAndTheForm()
    {
        $this->client = static::createClient();
        $this->dataFixture();

        $crawler = $this->client->request('GET', '/contact');

        $this->assertEquals('Formulaire de contact:', $crawler->filter('h2')->text());

        $form = $crawler->selectButton('Valider')->form();
        $form['contact_form[username]'] = 'usernameTest';
        $form['contact_form[email]'] = 'emailTest@gmail.com';
        $form['contact_form[content]'] = 'contentTest';
        $this->client->submit($form);

        $crawler = $this->client->reload();

        $this->assertSame(1, $crawler->filter('.alert-success')->count());
    }
}