<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column]

    private ?int $Order_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Order_date = null;

    #[ORM\Column]
    private ?bool $Order_status = null;

    #[ORM\Column]
    private ?float $Total_amount = null;

    #[ORM\ManyToOne(inversedBy: 'Commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Produit::class)]
    private Collection $Order_product;

    public function __construct()
    {
        $this->Order_product = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?int
    {
        return $this->Order_number;
    }

    public function setOrderNumber(int $Order_number): self
    {
        $this->Order_number = $Order_number;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->Order_date;
    }

    public function setOrderDate(\DateTimeInterface $Order_date): self
    {
        $this->Order_date = $Order_date;

        return $this;
    }

    public function isOrderStatus(): ?bool
    {
        return $this->Order_status;
    }

    public function setOrderStatus(bool $Order_status): self
    {
        $this->Order_status = $Order_status;

        return $this;
    }

    public function getTotalAmount(): ?float
    {
        return $this->Total_amount;
    }

    public function setTotalAmount(float $Total_amount): self
    {
        $this->Total_amount = $Total_amount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getOrderProduct(): Collection
    {
        return $this->Order_product;
    }

    public function addOrderProduct(Produit $orderProduct): self
    {
        if (!$this->Order_product->contains($orderProduct)) {
            $this->Order_product->add($orderProduct);
            $orderProduct->setCommande($this);
        }

        return $this;
    }

    public function removeOrderProduct(Produit $orderProduct): self
    {
        if ($this->Order_product->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getCommande() === $this) {
                $orderProduct->setCommande(null);
            }
        }

        return $this;
    }
}
