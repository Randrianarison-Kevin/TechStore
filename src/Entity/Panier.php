<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $Total_amount = null;

    #[ORM\Column]
    private ?float $Amount_Total = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: Produit::class)]
    private Collection $Produits_ajoutes;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'paniers')]
    private Collection $Add_product;

    public function __construct()
    {
        $this->Produits_ajoutes = new ArrayCollection();
        $this->Add_product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getAmountTotal(): ?float
    {
        return $this->Amount_Total;
    }

    public function setAmountTotal(float $Amount_Total): self
    {
        $this->Amount_Total = $Amount_Total;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduitsAjoutes(): Collection
    {
        return $this->Produits_ajoutes;
    }

    public function addProduitsAjoute(Produit $produitsAjoute): self
    {
        if (!$this->Produits_ajoutes->contains($produitsAjoute)) {
            $this->Produits_ajoutes->add($produitsAjoute);
            $produitsAjoute->setPanier($this);
        }

        return $this;
    }

    public function removeProduitsAjoute(Produit $produitsAjoute): self
    {
        if ($this->Produits_ajoutes->removeElement($produitsAjoute)) {
            // set the owning side to null (unless already changed)
            if ($produitsAjoute->getPanier() === $this) {
                $produitsAjoute->setPanier(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getTotalAmount(): ?string
    {
        return $this->Total_amount;
    }

    public function setTotalAmount(string $Total_amount): self
    {
        $this->Total_amount = $Total_amount;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getAddProduct(): Collection
    {
        return $this->Add_product;
    }

    public function addAddProduct(Produit $addProduct): self
    {
        if (!$this->Add_product->contains($addProduct)) {
            $this->Add_product->add($addProduct);
        }

        return $this;
    }

    public function removeAddProduct(Produit $addProduct): self
    {
        $this->Add_product->removeElement($addProduct);

        return $this;
    }


}
