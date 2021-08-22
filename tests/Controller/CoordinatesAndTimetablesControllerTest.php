<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 22/08/2021
 * Time: 11:41
 */

namespace App\Tests\Controller;


use App\DataFixtures\AdminUserFixture;
use App\DataFixtures\AppFixtures;
use App\Entity\User;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoordinatesAndTimetablesControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected function dataFixture()
    {
        $this->loadFixtures([
            AdminUserFixture::class,
            AppFixtures::class,
        ]);
    }

    public function tearDown(): void
    {
        $purger = new ORMPurger(self::$container->get('doctrine')->getManager());
        $purger->purge();
        parent::tearDown();
    }

    public function testAdminCoordinatesAndTimetablesPageDisplay()
    {
        $this->client = static::createClient();
        $this->dataFixture();

        $user = self::$container->get('doctrine')->getRepository(User::class)->findOneBy(['email' => 'test_email@gmail.com']);
        $this->client->loginUser($user);

        $crawler = $this->client->request('GET', 'admin/coordonneesethoraires');

        $this->assertEquals('Les coordonnées et horaires:', $crawler->filter('h5')->text());
    }
}