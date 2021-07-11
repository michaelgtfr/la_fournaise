<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 13/06/2021
 * Time: 20:56
 */

namespace App\Tests\Entity;


use App\Entity\DetailOrder;
use App\Entity\Location;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Validation;

class LocationTest extends TestCase
{
    public function testLocationEntityWithCorrectData()
    {
        $data = [
            'day' => 1,
            'address' => 'string',
            'city' => 'string',
            'beginHour' => new \DateTime(),
            'endTime' => new \DateTime(),
        ];

        $location = new Location();
        $location->setDay($data['day']);
        $location->setAddress($data['address']);
        $location->setCity($data['city']);
        $location->setBeginHour($data['beginHour']);
        $location->setEndTime($data['endTime']);

        $this->assertEquals(null, $location->getId());
        $this->assertEquals($data['day'], $location->getDay());
        $this->assertEquals($data['address'], $location->getAddress());
        $this->assertEquals($data['city'], $location->getCity());
        $this->assertEquals($data['beginHour'], $location->getBeginHour());
        $this->assertEquals($data['endTime'], $location->getEndTime());
    }

    public function testLocationEntityWithBadDataLengthPart()
    {
        $data = [
            'day' => str_pad(1,3 , "1", STR_PAD_BOTH),
            'address' => str_pad(1, 101, "1", STR_PAD_BOTH),
            'city' => str_pad(1, 61, "1", STR_PAD_BOTH),
        ];

        $location = new Location();
        $location->setDay($data['day']);
        $location->setAddress($data['address']);
        $location->setCity($data['city']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($location);

        $this->assertEquals(3, count($errors));
    }

    public function testLocationEntityWithBadDataExceptionPartOnTheBeginHourAttribute()
    {
        $data = [
            'beginHour' => [],
        ];

        $this->expectException(Error::class);
        $location = new Location();
        $location->setBeginHour($data['beginHour']);
    }
}