<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    public const STATUS_ACTIVE = 'ACTIVE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $open_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $close_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_activity = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?float $avail_balance = null;

    #[ORM\Column(nullable: true)]
    private ?float $pending_balance = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    private ?Employee $employee = null;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: Transaction::class)]
    private Collection $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpenDate(): ?\DateTimeInterface
    {
        return $this->open_date;
    }

    public function setOpenDate(\DateTimeInterface $open_date): static
    {
        $this->open_date = $open_date;

        return $this;
    }

    public function getCloseDate(): ?\DateTimeInterface
    {
        return $this->close_date;
    }

    public function setCloseDate(?\DateTimeInterface $close_date): static
    {
        $this->close_date = $close_date;

        return $this;
    }

    public function getLastActivity(): ?\DateTimeInterface
    {
        return $this->last_activity;
    }

    public function setLastActivity(?\DateTimeInterface $last_activity): static
    {
        $this->last_activity = $last_activity;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAvailBalance(): ?float
    {
        return $this->avail_balance;
    }

    public function setAvailBalance(?float $avail_balance): static
    {
        $this->avail_balance = $avail_balance;

        return $this;
    }

    public function getPendingBalance(): ?float
    {
        return $this->pending_balance;
    }

    public function setPendingBalance(?float $pending_balance): static
    {
        $this->pending_balance = $pending_balance;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

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

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setAccount($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getAccount() === $this) {
                $transaction->setAccount(null);
            }
        }

        return $this;
    }
}
