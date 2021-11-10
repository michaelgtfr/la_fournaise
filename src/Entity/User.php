<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\Length(max=60)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Assert\Type("array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\Type("string")
     * @Assert\Length(max=40)
     */
    private $nameOrderWithdrawal;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Length(max=10)
     */
    private $numberCellphone;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $confirmationAccount;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $confirmationKey;

    /**
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $confirmationPassword;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="users", orphanRemoval=true)
     * @Assert\Type("object")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getNameOrderWithdrawal(): ?string
    {
        return $this->nameOrderWithdrawal;
    }

    public function setNameOrderWithdrawal(string $nameOrderWithdrawal): self
    {
        $this->nameOrderWithdrawal = $nameOrderWithdrawal;

        return $this;
    }

    public function getNumberCellphone(): ?int
    {
        return $this->numberCellphone;
    }

    public function setNumberCellphone(int $numberCellphone): self
    {
        $this->numberCellphone = $numberCellphone;

        return $this;
    }

    public function getConfirmationAccount(): ?int
    {
        return $this->confirmationAccount;
    }

    public function setConfirmationAccount(int $confirmationAccount): self
    {
        $this->confirmationAccount = $confirmationAccount;

        return $this;
    }

    public function getConfirmationKey(): ?string
    {
        return $this->confirmationKey;
    }

    public function setConfirmationKey(string $confirmationKey): self
    {
        $this->confirmationKey = $confirmationKey;

        return $this;
    }

    public function getConfirmationPassword(): ?string
    {
        return $this->confirmationPassword;
    }

    public function setConfirmationPassword(string $confirmationPassword): self
    {
        $this->confirmationPassword = $confirmationPassword;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setUsers($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUsers() === $this) {
                $order->setUsers(null);
            }
        }

        return $this;
    }
}
