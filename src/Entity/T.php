<?php

namespace App\Entity;

use App\Repository\TRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TRepository::class)]
class T
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?float $openPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $highPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $lowPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $closePrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $volume = null;

    #[ORM\Column(nullable: true)]
    private ?float $adjusted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getOpenPrice(): ?float
    {
        return $this->openPrice;
    }

    public function setOpenPrice(?float $openPrice): static
    {
        $this->openPrice = $openPrice;

        return $this;
    }

    public function getHighPrice(): ?float
    {
        return $this->highPrice;
    }

    public function setHighPrice(?float $highPrice): static
    {
        $this->highPrice = $highPrice;

        return $this;
    }

    public function getLowPrice(): ?float
    {
        return $this->lowPrice;
    }

    public function setLowPrice(?float $lowPrice): static
    {
        $this->lowPrice = $lowPrice;

        return $this;
    }

    public function getClosePrice(): ?float
    {
        return $this->closePrice;
    }

    public function setClosePrice(?float $closePrice): static
    {
        $this->closePrice = $closePrice;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(?float $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getAdjusted(): ?float
    {
        return $this->adjusted;
    }

    public function setAdjusted(?float $adjusted): static
    {
        $this->adjusted = $adjusted;

        return $this;
    }
}
