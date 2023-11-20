<?php

namespace App\Entity;

use App\Repository\TraderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraderRepository::class)]
class Trader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fname = null;

    #[ORM\Column(length: 255)]
    private ?string $lname = null;

    #[ORM\Column]
    private ?float $trader_account = null;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Terminal::class)]
    private Collection $terminals;

    #[ORM\Column(nullable: true)]
    private ?float $change_account = null;

    public function __construct()
    {
        $this->terminals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): static
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): static
    {
        $this->lname = $lname;

        return $this;
    }

    public function getTraderAccount(): ?float
    {
        return $this->trader_account;
    }

    public function setTraderAccount(float $trader_account): static
    {
        $this->trader_account = $trader_account;

        return $this;
    }

    /**
     * @return Collection<int, Terminal>
     */
    public function getTerminals(): Collection
    {
        return $this->terminals;
    }

    public function addTerminal(Terminal $terminal): static
    {
        if (!$this->terminals->contains($terminal)) {
            $this->terminals->add($terminal);
            $terminal->setTrader($this);
        }

        return $this;
    }

    public function removeTerminal(Terminal $terminal): static
    {
        if ($this->terminals->removeElement($terminal)) {
            // set the owning side to null (unless already changed)
            if ($terminal->getTrader() === $this) {
                $terminal->setTrader(null);
            }
        }

        return $this;
    }

    public function getChangeAccount(): ?float
    {
        return $this->change_account;
    }

    public function setChangeAccount(?float $change_account): static
    {
        $this->change_account = $change_account;

        return $this;
    }
}
