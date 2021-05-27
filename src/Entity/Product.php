<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ingredientList;

    /**
     * @ORM\OneToMany(targetEntity=DetailOrder::class, mappedBy="products")
     */
    private $detailOrders;

    /**
     * @ORM\OneToOne(targetEntity=PictureProduct::class, inversedBy="products", cascade={"persist", "remove"})
     */
    private $pictures;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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
}
