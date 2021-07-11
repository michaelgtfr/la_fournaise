<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 29/05/2021
 * Time: 11:56
 */

namespace App\Tests\Entity;


use App\Entity\PromotionalCode;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class PromotionalCodeTest extends TestCase
{
    public function testPromotionalCodeEntityWithCorrectData()
    {
        $data = [
            'numberOffer' => 5,
            'unit' => 1,
            'subject' => 1
            ];

        $promotionalCode = new PromotionalCode();
        $promotionalCode->setNumberOffer($data['numberOffer']);
        $promotionalCode->setUnit($data['unit']);
        $promotionalCode->setSubject($data['subject']);

        $this->assertEquals(null, $promotionalCode->getId());
        $this->assertEquals($data['numberOffer'], $promotionalCode->getNumberOffer());
        $this->assertEquals($data['unit'], $promotionalCode->getUnit());
        $this->assertEquals($data['subject'], $promotionalCode->getSubject());
    }

    public function testPromotionalCodeEntityWithBadDataLenghtPart()
    {
        $data = [
            'numberOffer' => str_pad(1, 2, "1", STR_PAD_BOTH),
            'unit' => str_pad(1, 2, "1", STR_PAD_BOTH),
            'subject' => str_pad(1, 3, "1", STR_PAD_BOTH),
        ];

        $promotionalCode = new PromotionalCode();
        $promotionalCode->setNumberOffer($data['numberOffer']);
        $promotionalCode->setUnit($data['unit']);
        $promotionalCode->setSubject($data['subject']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($promotionalCode);

        $this->assertEquals(3, count($errors));
    }

    public function testPromotionalCodeEntityWithBadDataExceptionPartOnTheNumberOfferAttribute()
    {
        $data = [
            'numberOffer' => [],
        ];

        $this->expectException(Error::class);
        $user = new PromotionalCode();
        $user->setNumberOffer($data['numberOffer']);
    }
}