<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:InstrumentRepository::class)]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $symbol = null;

    #[ORM\Column(length: 255)]
    private ?string $AssetType;

    #[ORM\Column(length: 255)]
    private ?string $Name;

    #[ORM\Column(type: "text")]
    private $Description;

    #[ORM\Column]
    private ?int $CIK;

    #[ORM\Column]
    private ?string $Exchange;

    #[ORM\Column(length: 255)]
    private ?string $Currency;

    #[ORM\Column(length: 255)]
    private ?string $Country;

    #[ORM\Column(length: 255)]
    private ?string $Sector;

    #[ORM\Column(length: 255)]
    private ?string $Industry;

    #[ORM\Column(length: 255)]
    private ?string $Address;

    #[ORM\Column(length: 255)]
    private ?string $FiscalYearEnd;

    #[ORM\Column(length: 255)]
    private string $LatestQuarter;

    #[ORM\Column(type: "bigint")]
    private ?int $MarketCapitalization;

    #[ORM\Column(type: "bigint")]
    private ?int $EBITDA;

    #[ORM\Column]
    private ?float $PERatio;

    #[ORM\Column]
    private ?float $BookValue;

    #[ORM\Column]
    private ?float $DividendPerShare;

    #[ORM\Column]
    private ?float $DividendYield;

    #[ORM\Column]
    private ?float $EPS;

    #[ORM\Column]
    private ?float $RevenuePerShareTTM;

    #[ORM\Column]
    private ?float $ProfitMargin;

    #[ORM\Column]
    private ?float $OperatingMarginTTM;

    #[ORM\Column]
    private ?float $ReturnOnAssetsTTM;

    #[ORM\Column]
    private ?float $ReturnOnEquityTTM;

    #[ORM\Column(type: "bigint")]
    private ?int $RevenueTTM;

    #[ORM\Column(type: "bigint")]
    private ?int $GrossProfitTTM;

    #[ORM\Column]
    private ?float $DilutedEPSTTM;

    #[ORM\Column]
    private ?float $QuarterlyEarningsGrowthYOY;

    #[ORM\Column]
    private ?float $QuarterlyRevenueGrowthYOY;

    #[ORM\Column]
    private ?float $AnalystTargetPrice;

    #[ORM\Column]
    private ?float $TrailingPE;

    #[ORM\Column]
    private ?float $ForwardPE;

    #[ORM\Column]
    private ?float $PriceToSalesRatioTTM;

    #[ORM\Column]
    private ?float $PriceToBookRatio;

    #[ORM\Column]
    private ?float $EVToRevenue;

    #[ORM\Column]
    private ?float $EVToEBITDA;

    #[ORM\Column]
    private ?float $Beta;

    #[ORM\Column]
    private ?float $SharesOutstanding;

    #[ORM\Column]
    private ?float $DividendDate;

    #[ORM\Column]
    private ?float $ExDividendDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getAssetType(): ?string
    {
        return $this->AssetType;
    }

    public function setAssetType(string $AssetType): self
    {
        $this->AssetType = $AssetType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCIK(): ?int
    {
        return $this->CIK;
    }

    public function setCIK(int $CIK): self
    {
        $this->CIK = $CIK;

        return $this;
    }

    public function getExchange(): ?string
    {
        return $this->Exchange;
    }

    public function setExchange(string $Exchange): self
    {
        $this->Exchange = $Exchange;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->Sector;
    }

    public function setSector(string $Sector): self
    {
        $this->Sector = $Sector;

        return $this;
    }

    public function getIndustry(): ?string
    {
        return $this->Industry;
    }

    public function setIndustry(string $Industry): self
    {
        $this->Industry = $Industry;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getFiscalYearEnd(): ?string
    {
        return $this->FiscalYearEnd;
    }

    public function setFiscalYearEnd(string $FiscalYearEnd): self
    {
        $this->FiscalYearEnd = $FiscalYearEnd;

        return $this;
    }

    public function getLatestQuarter(): ?\DateTimeInterface
    {
        return $this->LatestQuarter;
    }

    public function setLatestQuarter(string $LatestQuarter): self
    {
        $this->LatestQuarter = $LatestQuarter;

        return $this;
    }

    public function getMarketCapitalization(): ?int
    {
        return $this->MarketCapitalization;
    }

    public function setMarketCapitalization(int $MarketCapitalization): self
    {
        $this->MarketCapitalization = $MarketCapitalization;

        return $this;
    }

    public function getEBITDA(): ?int
    {
        return $this->EBITDA;
    }

    public function setEBITDA(int $EBITDA): self
    {
        $this->EBITDA = $EBITDA;

        return $this;
    }

    public function getPERatio(): ?float
    {
        return $this->PERatio;
    }

    public function setPERatio(float $PERatio): self
    {
        $this->PERatio = $PERatio;

        return $this;
    }

    public function getBookValue(): ?float
    {
        return $this->BookValue;
    }

    public function setBookValue(float $BookValue): self
    {
        $this->BookValue = $BookValue;

        return $this;
    }

    public function getDividendPerShare(): ?float
    {
        return $this->DividendPerShare;
    }

    public function setDividendPerShare(float $DividendPerShare): self
    {
        $this->DividendPerShare = $DividendPerShare;

        return $this;
    }

    public function getDividendYield(): ?float
    {
        return $this->DividendYield;
    }

    public function setDividendYield(float $DividendYield): self
    {
        $this->DividendYield = $DividendYield;

        return $this;
    }

    public function getEPS(): ?float
    {
        return $this->EPS;
    }

    public function setEPS(float $EPS): self
    {
        $this->EPS = $EPS;

        return $this;
    }

    public function getRevenuePerShareTTM(): ?float
    {
        return $this->RevenuePerShareTTM;
    }

    public function setRevenuePerShareTTM(float $RevenuePerShareTTM): self
    {
        $this->RevenuePerShareTTM = $RevenuePerShareTTM;

        return $this;
    }

    public function getProfitMargin(): ?float
    {
        return $this->ProfitMargin;
    }

    public function setProfitMargin(float $ProfitMargin): self
    {
        $this->ProfitMargin = $ProfitMargin;

        return $this;
    }

    public function getOperatingMarginTTM(): ?float
    {
        return $this->OperatingMarginTTM;
    }

    public function setOperatingMarginTTM(float $OperatingMarginTTM): self
    {
        $this->OperatingMarginTTM = $OperatingMarginTTM;

        return $this;
    }

    public function getReturnOnAssetsTTM(): ?float
    {
        return $this->ReturnOnAssetsTTM;
    }

    public function setReturnOnAssetsTTM(float $ReturnOnAssetsTTM): self
    {
        $this->ReturnOnAssetsTTM = $ReturnOnAssetsTTM;

        return $this;
    }

    public function getReturnOnEquityTTM(): ?float
    {
        return $this->ReturnOnEquityTTM;
    }

    public function setReturnOnEquityTTM(float $ReturnOnEquityTTM): self
    {
        $this->ReturnOnEquityTTM = $ReturnOnEquityTTM;

        return $this;
    }

    public function getRevenueTTM(): ?int
    {
        return $this->RevenueTTM;
    }

    public function setRevenueTTM(int $RevenueTTM): self
    {
        $this->RevenueTTM = $RevenueTTM;

        return $this;
    }

    public function getGrossProfitTTM(): ?int
    {
        return $this->GrossProfitTTM;
    }

    public function setGrossProfitTTM(int $GrossProfitTTM): self
    {
        $this->GrossProfitTTM = $GrossProfitTTM;

        return $this;
    }

    public function getDilutedEPSTTM(): ?float
    {
        return $this->DilutedEPSTTM;
    }

    public function setDilutedEPSTTM(float $DilutedEPSTTM): self
    {
        $this->DilutedEPSTTM = $DilutedEPSTTM;

        return $this;
    }

    public function getQuarterlyEarningsGrowthYOY(): ?float
    {
        return $this->QuarterlyEarningsGrowthYOY;
    }

    public function setQuarterlyEarningsGrowthYOY(float $QuarterlyEarningsGrowthYOY): self
    {
        $this->QuarterlyEarningsGrowthYOY = $QuarterlyEarningsGrowthYOY;

        return $this;
    }

    public function getQuarterlyRevenueGrowthYOY(): ?float
    {
        return $this->QuarterlyRevenueGrowthYOY;
    }

    public function setQuarterlyRevenueGrowthYOY(float $QuarterlyRevenueGrowthYOY): self
    {
        $this->QuarterlyRevenueGrowthYOY = $QuarterlyRevenueGrowthYOY;

        return $this;
    }

    public function getAnalystTargetPrice(): ?float
    {
        return $this->AnalystTargetPrice;
    }

    public function setAnalystTargetPrice(float $AnalystTargetPrice): self
    {
        $this->AnalystTargetPrice = $AnalystTargetPrice;

        return $this;
    }

    public function getTrailingPE(): ?float
    {
        return $this->TrailingPE;
    }

    public function setTrailingPE(float $TrailingPE): self
    {
        $this->TrailingPE = $TrailingPE;

        return $this;
    }

    public function getForwardPE(): ?float
    {
        return $this->ForwardPE;
    }

    public function setForwardPE(float $ForwardPE): self
    {
        $this->ForwardPE = $ForwardPE;

        return $this;
    }

    public function getPriceToSalesRatioTTM(): ?float
    {
        return $this->PriceToSalesRatioTTM;
    }

    public function setPriceToSalesRatioTTM(float $PriceToSalesRatioTTM): self
    {
        $this->PriceToSalesRatioTTM = $PriceToSalesRatioTTM;

        return $this;
    }

    public function getPriceToBookRatio(): ?float
    {
        return $this->PriceToBookRatio;
    }

    public function setPriceToBookRatio(float $PriceToBookRatio): self
    {
        $this->PriceToBookRatio = $PriceToBookRatio;

        return $this;
    }

    public function getEVToRevenue(): ?float
    {
        return $this->EVToRevenue;
    }

    public function setEVToRevenue(float $EVToRevenue): self
    {
        $this->EVToRevenue = $EVToRevenue;

        return $this;
    }

    public function getEVToEBITDA(): ?float
    {
        return $this->EVToEBITDA;
    }

    public function setEVToEBITDA(float $EVToEBITDA): self
    {
        $this->EVToEBITDA = $EVToEBITDA;

        return $this;
    }

    public function getBeta(): ?float
    {
        return $this->Beta;
    }

    public function setBeta(float $Beta): self
    {
        $this->Beta = $Beta;

        return $this;
    }

    public function getSharesOutstanding(): ?int
    {
        return $this->SharesOutstanding;
    }

    public function setSharesOutstanding(int $SharesOutstanding): self
    {
        $this->SharesOutstanding = $SharesOutstanding;

        return $this;
    }

    public function getDividendDate(): ?\DateTimeInterface
    {
        return $this->DividendDate;
    }

    public function setDividendDate($DividendDate): self
    {
        $this->DividendDate = $DividendDate;

        return $this;
    }

    public function getExDividendDate(): ?\DateTimeInterface
    {
        return $this->ExDividendDate;
    }

    public function setExDividendDate($ExDividendDate): self
    {
        $this->ExDividendDate = $ExDividendDate;

        return $this;
    }

}
