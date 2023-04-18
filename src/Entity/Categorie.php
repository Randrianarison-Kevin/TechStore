<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Categories_name = null;

    #[ORM\Column(length: 255)]
    private ?string $Categories_description = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'Categories')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoriesName(): ?string
    {
        return $this->Categories_name;
    }

    public function setCategoriesName(string $Categories_name): self
    {
        $this->Categories_name = $Categories_name;

        return $this;
    }

    public function getCategoriesDescription(): ?string
    {
        return $this->Categories_description;
    }

    public function setCategoriesDescription(string $Categories_description): self
    {
        $this->Categories_description = $Categories_description;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addCategory($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeCategory($this);
        }

        return $this;
    }
}
