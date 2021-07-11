<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\Unique
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(max=2)
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60)
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $beginHour;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $endTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBeginHour(): ?\DateTimeInterface
    {
        return $this->beginHour;
    }

    public function setBeginHour(\DateTimeInterface $beginHour): self
    {
        $this->beginHour = $beginHour;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }
}
