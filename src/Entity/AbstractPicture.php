<?php

namespace App\Entity;

use App\Repository\AbstractPictureRepository;
use Doctrine\ORM\Mapping as ORM;

Abstract class AbstractPicture
{
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $namePicture;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $extensionPicture;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $descriptionPicture;


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
