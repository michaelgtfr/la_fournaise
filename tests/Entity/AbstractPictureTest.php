<?php
/**
 * Created by PhpStorm.
 * User: michaelgt
 * Date: 31/05/2021
 * Time: 18:32
 */

namespace App\Tests\Entity;


use App\Entity\AbstractPicture;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AbstractPictureTest extends TestCase
{
    public function testAbstractPictureEntityWithCorrectData()
    {
        $data = [
            'namePicture' => 'nameTest',
            'extensionPicture' => 'jpg',
            'descriptionPicture' => 'description test'
        ];

        $abstractPicture = $this->getMockForAbstractClass(AbstractPicture::class);

        $abstractPicture->setNamePicture($data['namePicture']);
        $abstractPicture->setExtensionPicture($data['extensionPicture']);
        $abstractPicture->setDescriptionPicture($data['descriptionPicture']);

        $this->assertEquals($data['namePicture'], $abstractPicture->getNamePicture());
        $this->assertEquals($data['extensionPicture'], $abstractPicture->getExtensionPicture());
        $this->assertEquals($data['descriptionPicture'], $abstractPicture->getDescriptionPicture());
    }

    public function testAbstractPictureEntityWithBadDataLengthPart()
    {
        $data = [
            'namePicture' => str_pad(1, 61, "1", STR_PAD_BOTH),
            'extensionPicture' => str_pad(1, 61, "1", STR_PAD_BOTH),
            'descriptionPicture' => str_pad(1, 101, "1", STR_PAD_BOTH)
        ];

        $abstractPicture = $this->getMockForAbstractClass(AbstractPicture::class);

        $abstractPicture->setNamePicture($data['namePicture']);
        $abstractPicture->setExtensionPicture($data['extensionPicture']);
        $abstractPicture->setDescriptionPicture($data['descriptionPicture']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($abstractPicture);

        $this->assertEquals(3, count($errors));
    }

    public function testUserEntityWithBadDataExceptionPartOnTheEmailAttribute()
    {
        $data = [
            'namePicture' => [],
        ];

        $this->expectException(Error::class);
        $abstractPicture = $this->getMockForAbstractClass(AbstractPicture::class);
        $abstractPicture->setNamePicture($data['namePicture']);
    }
}