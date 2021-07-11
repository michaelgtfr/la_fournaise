<?php

namespace App\Entity;

use App\Repository\PictureProductRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureProductRepository::class)
 */
class PictureProduct extends AbstractPicture
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
     * @ORM\OneToOne(targetEntity=Product::class, mappedBy="pictures", cascade={"persist", "remove"})
     * @Assert\Type("object")
     */
    private $products;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): self
    {
        // unset the owning side of the relation if necessary
        if ($products === null && $this->products !== null) {
            $this->products->setPictures(null);
        }

        // set the owning side of the relation if necessary
        if ($products !== null && $products->getPictures() !== $this) {
            $products->setPictures($this);
        }

        $this->products = $products;

        return $this;
    }
}
