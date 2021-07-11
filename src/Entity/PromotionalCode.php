<?php

namespace App\Entity;

use App\Repository\PromotionalCodeRepository;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\Unique
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Length(max=1)
     */
    private $numberOffer;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Length(max=1)
     */
    private $unit;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Length(max=2)
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
