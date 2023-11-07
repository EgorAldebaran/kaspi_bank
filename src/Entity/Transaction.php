<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $txn_date = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $txn_type = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $funds_avail_date = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Account $account = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Employee $employee = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Branch $branch = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTxnDate(): ?\DateTimeInterface
    {
        return $this->txn_date;
    }

    public function setTxnDate(\DateTimeInterface $txn_date): static
    {
        $this->txn_date = $txn_date;

        return $this;
    }

    public function getTxnType(): ?string
    {
        return $this->txn_type;
    }

    public function setTxnType(?string $txn_type): static
    {
        $this->txn_type = $txn_type;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getFundsAvailDate(): ?\DateTimeInterface
    {
        return $this->funds_avail_date;
    }

    public function setFundsAvailDate(?\DateTimeInterface $funds_avail_date): static
    {
        $this->funds_avail_date = $funds_avail_date;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): static
    {
        $this->branch = $branch;

        return $this;
    }
}
