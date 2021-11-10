<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/10/2021
 * Time: 09:11
 */

namespace App\Tests\Controller;


use App\DataFixtures\ClientUserFixture;
use App\Entity\User;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientDashboardControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected $client = null;

    protected function dataFixture()
    {
        $this->loadFixtures([
            ClientUserFixture::class,
        ])->getReferenceRepository();;
    }

    public function tearDown(): void
    {
        $purger = new ORMPurger(self::$container->get('doctrine')->getManager());
        $purger->purge();
        parent::tearDown();
    }

    public function testAdminPageDisplay()
    {
        $this->client = static::createClient();
        $this->dataFixture();

        $user = self::$container->get('doctrine')->getRepository(User::class)->findOneBy(['email' => 'test_email@gmail.com']);
        $this->client->loginUser($user);

        $id = $this->fixtures->getReference('clientUserId')->getId();

        $crawler = $this->client->request('GET', 'profile/dashboardClient/{id}', [
            'id' => $id
        ]);

        $this->assertEquals('Mes données', $crawler->filter('h2')->text());
    }
}