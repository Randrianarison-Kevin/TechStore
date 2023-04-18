<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Payment_method = null;

    #[ORM\Column]
    private ?float $Payroll_amount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Payment_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->Payment_method;
    }

    public function setPaymentMethod(string $Payment_method): self
    {
        $this->Payment_method = $Payment_method;

        return $this;
    }

    public function getPayrollAmount(): ?float
    {
        return $this->Payroll_amount;
    }

    public function setPayrollAmount(float $Payroll_amount): self
    {
        $this->Payroll_amount = $Payroll_amount;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->Payment_date;
    }

    public function setPaymentDate(\DateTimeInterface $Payment_date): self
    {
        $this->Payment_date = $Payment_date;

        return $this;
    }
}
