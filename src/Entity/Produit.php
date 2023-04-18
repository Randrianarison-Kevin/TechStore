<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Product_name = null;

    #[ORM\Column(length: 255)]
    private ?string $Product_Description = null;

    #[ORM\Column]
    private ?float $Product_price = null;

    #[ORM\Column]
    private ?int $Product_quantity = null;

    #[ORM\Column(type: Types::BLOB)]
    private $Product_image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Product_creation_date = null;

    #[ORM\ManyToOne(inversedBy: 'Order_product')]
    private ?Commande $commande = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'produits')]
    private Collection $Categories;

    #[ORM\ManyToOne(inversedBy: 'Produits_ajoutes')]
    private ?Panier $panier = null;

    #[ORM\ManyToMany(targetEntity: Panier::class, mappedBy: 'Add_product')]
    private Collection $paniers;

    public function __construct()
    {
        $this->Categories = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->Product_name;
    }

    public function setProductName(string $Product_name): self
    {
        $this->Product_name = $Product_name;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->Product_Description;
    }

    public function setProductDescription(string $Product_Description): self
    {
        $this->Product_Description = $Product_Description;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->Product_price;
    }

    public function setProductPrice(float $Product_price): self
    {
        $this->Product_price = $Product_price;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->Product_quantity;
    }

    public function setProductQuantity(int $Product_quantity): self
    {
        $this->Product_quantity = $Product_quantity;

        return $this;
    }

    public function getProductImage()
    {
        return $this->Product_image;
    }

    public function setProductImage($Product_image): self
    {
        $this->Product_image = $Product_image;

        return $this;
    }

    public function getProductCreationDate(): ?\DateTimeInterface
    {
        return $this->Product_creation_date;
    }

    public function setProductCreationDate(\DateTimeInterface $Product_creation_date): self
    {
        $this->Product_creation_date = $Product_creation_date;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->Categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->Categories->contains($category)) {
            $this->Categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->Categories->removeElement($category);

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->addAddProduct($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            $panier->removeAddProduct($this);
        }

        return $this;
    }
}
