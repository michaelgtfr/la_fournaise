<?php

namespace App\Entity;

use App\Repository\ApplicationInformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationInformationRepository::class)
 */
class ApplicationInformation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $emailApplication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookApplication;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneNumberApplication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailApplication(): ?string
    {
        return $this->emailApplication;
    }

    public function setEmailApplication(?string $emailApplication): self
    {
        $this->emailApplication = $emailApplication;

        return $this;
    }

    public function getFacebookApplication(): ?string
    {
        return $this->facebookApplication;
    }

    public function setFacebookApplication(?string $facebookApplication): self
    {
        $this->facebookApplication = $facebookApplication;

        return $this;
    }

    public function getPhoneNumberApplication(): ?int
    {
        return $this->phoneNumberApplication;
    }

    public function setPhoneNumberApplication(?int $phoneNumberApplication): self
    {
        $this->phoneNumberApplication = $phoneNumberApplication;

        return $this;
    }
}
