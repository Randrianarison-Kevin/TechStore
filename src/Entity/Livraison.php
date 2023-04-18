<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Delivery_adress = null;

    #[ORM\Column(length: 255)]
    private ?string $Destinataire = null;

    #[ORM\Column]
    private ?int $Number_suivi = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commande $Commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryAdress(): ?string
    {
        return $this->Delivery_adress;
    }

    public function setDeliveryAdress(string $Delivery_adress): self
    {
        $this->Delivery_adress = $Delivery_adress;

        return $this;
    }

    public function getDestinataire(): ?string
    {
        return $this->Destinataire;
    }

    public function setDestinataire(string $Destinataire): self
    {
        $this->Destinataire = $Destinataire;

        return $this;
    }

    public function getNumberSuivi(): ?int
    {
        return $this->Number_suivi;
    }

    public function setNumberSuivi(int $Number_suivi): self
    {
        $this->Number_suivi = $Number_suivi;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): self
    {
        $this->Commande = $Commande;

        return $this;
    }
}
