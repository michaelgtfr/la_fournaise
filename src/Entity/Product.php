<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $presentation;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\Length(max=3)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\NotBlank
     * @Assert\Length(max=1)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Type("string")
     * @Assert\Length(max=100)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Type("string")
     * @Assert\Length(max=100)
     */
    private $ingredientList;

    /**
     * @ORM\OneToMany(targetEntity=DetailOrder::class, mappedBy="products")
     * @Assert\Type("object")
     */
    private $detailOrders;

    /**
     * @ORM\OneToOne(targetEntity=PictureProduct::class, inversedBy="products", cascade={"persist", "remove"})
     * @Assert\Type("object")
     */
    private $pictures;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeOfProduct;

    public function __construct()
    {
        $this->detailOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price/100;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price*100;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIngredientList(): ?string
    {
        return $this->ingredientList;
    }

    public function setIngredientList(string $ingredientList): self
    {
        $this->ingredientList = $ingredientList;

        return $this;
    }

    /**
     * @return Collection|DetailOrder[]
     */
    public function getDetailOrders(): Collection
    {
        return $this->detailOrders;
    }

    public function addDetailOrder(DetailOrder $detailOrder): self
    {
        if (!$this->detailOrders->contains($detailOrder)) {
            $this->detailOrders[] = $detailOrder;
            $detailOrder->setProducts($this);
        }

        return $this;
    }

    public function removeDetailOrder(DetailOrder $detailOrder): self
    {
        if ($this->detailOrders->removeElement($detailOrder)) {
            // set the owning side to null (unless already changed)
            if ($detailOrder->getProducts() === $this) {
                $detailOrder->setProducts(null);
            }
        }

        return $this;
    }

    public function getPictures(): ?PictureProduct
    {
        return $this->pictures;
    }

    public function setPictures(?PictureProduct $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getTypeOfProduct(): ?int
    {
        return $this->typeOfProduct;
    }

    public function setTypeOfProduct(int $typeOfProduct): self
    {
        $this->typeOfProduct = $typeOfProduct;

        return $this;
    }
}
