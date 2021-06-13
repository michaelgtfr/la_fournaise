<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

Abstract class AbstractPicture
{
    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Type("string")
     * @Assert\Length(max=60)
     */
    protected $namePicture;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\Type("string")
     * @Assert\Length(max=4)
     */
    protected $extensionPicture;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Type("string")
     * @Assert\Length(max=100)
     */
    protected $descriptionPicture;


    public function getNamePicture(): ?string
    {
        return $this->namePicture;
    }

    public function setNamePicture(string $namePicture): self
    {
        $this->namePicture = $namePicture;

        return $this;
    }

    public function getExtensionPicture(): ?string
    {
        return $this->extensionPicture;
    }

    public function setExtensionPicture(string $extensionPicture): self
    {
        $this->extensionPicture = $extensionPicture;

        return $this;
    }

    public function getDescriptionPicture(): ?string
    {
        return $this->descriptionPicture;
    }

    public function setDescriptionPicture(string $descriptionPicture): self
    {
        $this->descriptionPicture = $descriptionPicture;

        return $this;
    }
}
