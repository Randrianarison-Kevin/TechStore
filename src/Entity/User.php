<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $User_name = null;

    #[ORM\Column(length: 255)]
    private ?string $user_first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $User_email = null;

    #[ORM\Column(length: 255)]
    private ?string $User_password = null;

    #[ORM\Column(length: 255)]
    private ?string $User_adress = null;

    #[ORM\Column]
    private ?int $User_telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $User_registration_date = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commande::class)]
    private Collection $Commande;

    #[ORM\ManyToOne(inversedBy: 'User')]
    private ?Commentaire $commentaire = null;

    public function __construct()
    {
        $this->Commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->User_name;
    }

    public function setUserName(string $User_name): self
    {
        $this->User_name = $User_name;

        return $this;
    }

    public function getUserFirstName(): ?string
    {
        return $this->user_first_name;
    }

    public function setUserFirstName(string $user_first_name): self
    {
        $this->user_first_name = $user_first_name;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->User_email;
    }

    public function setUserEmail(string $User_email): self
    {
        $this->User_email = $User_email;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->User_password;
    }

    public function setUserPassword(string $User_password): self
    {
        $this->User_password = $User_password;

        return $this;
    }

    public function getUserAdress(): ?string
    {
        return $this->User_adress;
    }

    public function setUserAdress(string $User_adress): self
    {
        $this->User_adress = $User_adress;

        return $this;
    }

    public function getUserTelephone(): ?int
    {
        return $this->User_telephone;
    }

    public function setUserTelephone(int $User_telephone): self
    {
        $this->User_telephone = $User_telephone;

        return $this;
    }

    public function getUserRegistrationDate(): ?\DateTimeInterface
    {
        return $this->User_registration_date;
    }

    public function setUserRegistrationDate(\DateTimeInterface $User_registration_date): self
    {
        $this->User_registration_date = $User_registration_date;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande->add($commande);
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->Commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
