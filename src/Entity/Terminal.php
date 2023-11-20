<?php

namespace App\Entity;

use App\Repository\TerminalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TerminalRepository::class)]
class Terminal
{
    public const OPEN_TRADE = 0;
    public const CLOSE_TRADE = 1;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'terminals')]
    private ?Trader $trader = null;

    #[ORM\Column(nullable: true)]
    private ?float $pos_entry = null;

    #[ORM\Column(nullable: true)]
    private ?float $pos_close = null;

    #[ORM\Column(nullable: true)]
    private ?float $trading_result = null;

    #[ORM\Column(length: 255)]
    private ?string $instrument = null;

    #[ORM\Column]
    private ?int $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrader(): ?Trader
    {
        return $this->trader;
    }

    public function setTrader(?Trader $trader): static
    {
        $this->trader = $trader;

        return $this;
    }

    public function getPosEntry(): ?float
    {
        return $this->pos_entry;
    }

    public function setPosEntry(?float $pos_entry): static
    {
        $this->pos_entry = $pos_entry;

        return $this;
    }

    public function getPosClose(): ?float
    {
        return $this->pos_close;
    }

    public function setPosClose(?float $pos_close): static
    {
        $this->pos_close = $pos_close;

        return $this;
    }

    public function getTradingResult(): ?float
    {
        return $this->trading_result;
    }

    public function setTradingResult(?float $trading_result): static
    {
        $this->trading_result = $trading_result;

        return $this;
    }

    public function getInstrument(): ?string
    {
        return $this->instrument;
    }

    public function setInstrument(string $instrument): static
    {
        $this->instrument = $instrument;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
