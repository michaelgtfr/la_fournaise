<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 10:33
 */

namespace App\Tests\Entity;


use App\Entity\Event;
use App\Entity\PictureEvent;
use Error;
use PHPUnit\Framework\TestCase;

class PictureEventTest extends TestCase
{
    public function testPictureEventEntityWithCorrectData()
    {
        $event = new Event();

        $pictureEvent = new PictureEvent();
        $pictureEvent->setEvents($event);

        $this->assertEquals(null, $pictureEvent->getId());
        $this->assertEquals($event, $pictureEvent->getEvents());
    }

    public function testEventEntityWithBadDataExceptionPartOnThePictureEventRelationAttribute()
    {
        $data = [
            'event' => [],
        ];

        $this->expectException(Error::class);
        $user = new PictureEvent();
        $user->setEvents($data['event']);
    }
}
