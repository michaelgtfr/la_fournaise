<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 30/05/2021
 * Time: 09:45
 */

namespace App\Tests\Entity;


use App\Entity\Event;
use App\Entity\PictureEvent;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class EventTest extends TestCase
{
    public function testEventEntityWithCorrectData()
    {
        $data = [
            'title' => 'titleTest',
            'subtitle' => 'subtitleTest',
            'chapo' => 'chapoTest',
            'content' => 'contentTest'
        ];
        $pictureEvent = new PictureEvent();

        $event = new Event();
        $event->setTitle($data['title']);
        $event->setSubtitle($data['subtitle']);
        $event->setChapo($data['chapo']);
        $event->setContent($data['content']);
        $event->addPictureEvent($pictureEvent);

        $this->assertEquals(null, $event->getId());
        $this->assertEquals($data['title'], $event->getTitle());
        $this->assertEquals($data['subtitle'], $event->getSubtitle());
        $this->assertEquals($data['chapo'], $event->getChapo());
        $this->assertEquals($data['content'], $event->getContent());
        $this->assertContains($pictureEvent, $event->getPictureEvents());

        $event->removePictureEvent($pictureEvent);
        $this->assertNotContains($pictureEvent, $event->getPictureEvents());
    }

    public function testEventEntityWithBadDataLenghtPart()
    {
        $data = [
            'title' => str_pad(1, 101, "1", STR_PAD_BOTH),
            'subtitle' => str_pad(1, 151, "1", STR_PAD_BOTH),
            'chapo' => str_pad(1, 256, "1", STR_PAD_BOTH),
            'content' => str_pad(1, 1001, "1", STR_PAD_BOTH),
        ];

        $event = new Event();
        $event->setTitle($data['title']);
        $event->setSubtitle($data['subtitle']);
        $event->setChapo($data['chapo']);
        $event->setContent($data['content']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($event);

        $this->assertEquals(4, count($errors));
    }

    public function testEventEntityWithBadDataExceptionPartOnTheTitleAttribute()
    {
        $data = [
            'title' => [],
        ];

        $this->expectException(Error::class);
        $user = new Event();
        $user->setTitle($data['title']);
    }

    public function testEventEntityWithBadDataExceptionPartOnThePictureEventRelationAttribute()
    {
        $data = [
            'pictureEvent' => [],
        ];

        $this->expectException(Error::class);
        $user = new Event();
        $user->addPictureEvent($data['pictureEvent']);
    }
}
