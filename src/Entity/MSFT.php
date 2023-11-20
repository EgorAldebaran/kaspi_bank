<?php

namespace App\Entity;

use App\Repository\MSFTRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MSFTRepository::class)]
class MSFT
{
    public const TYPE_CHANGE_LEVEL = 1;
    public const TYPE_CHANGE_TREND = 2;
    public const TYPE_CHANGE_GREAT_TREND = 3;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $open_price = null;

    #[ORM\Column]
    private ?float $high_price = null;

    #[ORM\Column]
    private ?float $low_price = null;

    #[ORM\Column]
    private ?float $close_price = null;

    #[ORM\Column]
    private ?int $volume = null;

    #[ORM\Column]
    private ?float $adjusted = null;

    #[ORM\Column(nullable: true)]
    private ?int $typeChange = null;

    #[ORM\Column(nullable: true)]
    private ?float $sma_200 = null;

    #[ORM\Column(nullable: true)]
    private ?float $sma_50 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getOpenPrice(): ?float
    {
        return $this->open_price;
    }

    public function setOpenPrice(float $open_price): static
    {
        $this->open_price = $open_price;

        return $this;
    }

    public function getHighPrice(): ?float
    {
        return $this->high_price;
    }

    public function setHighPrice(float $high_price): static
    {
        $this->high_price = $high_price;

        return $this;
    }

    public function getLowPrice(): ?float
    {
        return $this->low_price;
    }

    public function setLowPrice(float $low_price): static
    {
        $this->low_price = $low_price;

        return $this;
    }

    public function getClosePrice(): ?float
    {
        return $this->close_price;
    }

    public function setClosePrice(float $close_price): static
    {
        $this->close_price = $close_price;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getAdjusted(): ?float
    {
        return $this->adjusted;
    }

    public function setAdjusted(float $adjusted): static
    {
        $this->adjusted = $adjusted;

        return $this;
    }

    public function getTypeChange(): ?int
    {
        return $this->typeChange;
    }

    public function setTypeChange(?int $typeChange): static
    {
        $this->typeChange = $typeChange;

        return $this;
    }

    public function getSma200(): ?float
    {
        return $this->sma_200;
    }

    public function setSma200(?float $sma_200): static
    {
        $this->sma_200 = $sma_200;

        return $this;
    }

    public function getSma50(): ?float
    {
        return $this->sma_50;
    }

    public function setSma50(?float $sma_50): static
    {
        $this->sma_50 = $sma_50;

        return $this;
    }
}
