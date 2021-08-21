<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/08/2021
 * Time: 16:41
 */

namespace App\Tests\Controller;


use App\DataFixtures\AdminUserFixture;
use App\DataFixtures\ApplicationInformationFixture;
use App\Entity\User;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminDashboardControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected $client = null;

    protected function dataFixture()
    {
        $this->loadFixtures([
            AdminUserFixture::class,
            ApplicationInformationFixture::class
        ]);
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

        $crawler = $this->client->request('GET', 'admin/dashboardadmin');

        $this->assertEquals('Mes données', $crawler->filter('h2')->text());
    }

}