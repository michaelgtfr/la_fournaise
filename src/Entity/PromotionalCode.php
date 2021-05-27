<?php

namespace App\Entity;

use App\Repository\PromotionalCodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionalCodeRepository::class)
 */
class PromotionalCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOffer;

    /**
     * @ORM\Column(type="integer")
     */
    private $unit;

    /**
     * @ORM\Column(type="integer")
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOffer(): ?int
    {
        return $this->numberOffer;
    }

    public function setNumberOffer(int $numberOffer): self
    {
        $this->numberOffer = $numberOffer;

        return $this;
    }

    public function getUnit(): ?int
    {
        return $this->unit;
    }

    public function setUnit(int $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getSubject(): ?int
    {
        return $this->subject;
    }

    public function setSubject(int $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
