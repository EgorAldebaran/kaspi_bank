<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Parser\Parser;
use App\Entity\Instrument;

class FinAnalysTest extends KernelTestCase
{
    /**
    * @var EntityManagerInterface 
    */
    protected $doctrine;

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function looktestAvadaKedavra()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http:/localhost/api/product');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);
        curl_close($curl);
        var_dump ($output);
            
    }

    /// каждая строка это компания
    public function xxxtestCreateAndSaveInstrument()
    {
        $url = "https://www.alphavantage.co/query?function=OVERVIEW&symbol=IBM&apikey=WAII57B91ROAWB4K";
        $cave_of_the_dragons = [
            "MSFT", "T", "ORCL", "CF","CTVA","FMC"
        ];

        $system_company = [];
        for ($i = 0; $i < count($cave_of_the_dragons); $i++) {
            $system_company[$i] = new Instrument;
        }

        $system_urls = [];
        $fundamental_dragon = [];

        foreach ($cave_of_the_dragons as $cave) {
            $fundamental_dragon[] = new Parser("https://www.alphavantage.co/query?function=OVERVIEW&symbol=".$cave."&apikey=WAII57B91ROAWB4K");
        }

        for ($i = 0; $i < count($cave_of_the_dragons); $i++) {
            
            $system_company[$i]->setSymbol($fundamental_dragon[$i]->getJson()->Symbol);
            $system_company[$i]->setAssetType($fundamental_dragon[$i]->getJson()->AssetType);
            $system_company[$i]->setName($fundamental_dragon[$i]->getJson()->Name);
            $system_company[$i]->setDescription($fundamental_dragon[$i]->getJson()->Description);
            $system_company[$i]->setCIK($fundamental_dragon[$i]->getJson()->CIK);
            $system_company[$i]->setExchange($fundamental_dragon[$i]->getJson()->Exchange);
            $system_company[$i]->setCurrency($fundamental_dragon[$i]->getJson()->Currency);
            $system_company[$i]->setCountry($fundamental_dragon[$i]->getJson()->Country);
            $system_company[$i]->setSector($fundamental_dragon[$i]->getJson()->Sector);
            $system_company[$i]->setIndustry($fundamental_dragon[$i]->getJson()->Industry);
            $system_company[$i]->setAddress($fundamental_dragon[$i]->getJson()->Address);
            $system_company[$i]->setFiscalYearEnd($fundamental_dragon[$i]->getJson()->FiscalYearEnd);
            $system_company[$i]->setLatestQuarter($fundamental_dragon[$i]->getJson()->LatestQuarter);
            $system_company[$i]->setMarketCapitalization($fundamental_dragon[$i]->getJson()->MarketCapitalization);
            $system_company[$i]->setEBITDA($fundamental_dragon[$i]->getJson()->EBITDA);
            $system_company[$i]->setPERatio($fundamental_dragon[$i]->getJson()->PERatio);
            $system_company[$i]->setBookValue($fundamental_dragon[$i]->getJson()->BookValue);
            $system_company[$i]->setDividendPerShare($fundamental_dragon[$i]->getJson()->DividendPerShare);
            $system_company[$i]->setDividendYield($fundamental_dragon[$i]->getJson()->DividendYield);
            $system_company[$i]->setEPS($fundamental_dragon[$i]->getJson()->EPS);
            $system_company[$i]->setRevenuePerShareTTM($fundamental_dragon[$i]->getJson()->RevenuePerShareTTM);
            $system_company[$i]->setProfitMargin($fundamental_dragon[$i]->getJson()->ProfitMargin);
            $system_company[$i]->setOperatingMarginTTM($fundamental_dragon[$i]->getJson()->OperatingMarginTTM);
            $system_company[$i]->setReturnOnAssetsTTM($fundamental_dragon[$i]->getJson()->ReturnOnAssetsTTM);
            $system_company[$i]->setRevenueTTM($fundamental_dragon[$i]->getJson()->RevenueTTM);
            $system_company[$i]->setGrossProfitTTM($fundamental_dragon[$i]->getJson()->GrossProfitTTM);
            $system_company[$i]->setDilutedEPSTTM($fundamental_dragon[$i]->getJson()->DilutedEPSTTM);
            $system_company[$i]->setQuarterlyEarningsGrowthYOY($fundamental_dragon[$i]->getJson()->QuarterlyEarningsGrowthYOY);
            $system_company[$i]->setQuarterlyRevenueGrowthYOY($fundamental_dragon[$i]->getJson()->QuarterlyRevenueGrowthYOY);
            $system_company[$i]->setAnalystTargetPrice($fundamental_dragon[$i]->getJson()->AnalystTargetPrice);
            $system_company[$i]->setTrailingPE($fundamental_dragon[$i]->getJson()->TrailingPE);
            $system_company[$i]->setForwardPE($fundamental_dragon[$i]->getJson()->ForwardPE);
            $system_company[$i]->setPriceToSalesRatioTTM($fundamental_dragon[$i]->getJson()->PriceToSalesRatioTTM);
            $system_company[$i]->setPriceToBookRatio($fundamental_dragon[$i]->getJson()->PriceToBookRatio);
            $system_company[$i]->setEVToRevenue($fundamental_dragon[$i]->getJson()->EVToRevenue);
            $system_company[$i]->setEVToEBITDA($fundamental_dragon[$i]->getJson()->EVToEBITDA);
            $system_company[$i]->setBeta($fundamental_dragon[$i]->getJson()->Beta);
            ///$system_company[$i]->setW52WeekHigh($fundamental_dragon[$i]->getJson()->52WeekHigh);
            ///$system_company[$i]->setW52WeekLow($fundamental_dragon[$i]->getJson()->52WeekLow);
            ///$system_company[$i]->setM50MDayMovingAverage($fundamental_dragon[$i]->getJson()->50DayMovingAverage);
            ///$system_company[$i]->setM200DayMovingAverage($fundamental_dragon[$i]->getJson()->200DayMovingAverage);
            $system_company[$i]->setSharesOutstanding($fundamental_dragon[$i]->getJson()->SharesOutstanding);
            $system_company[$i]->setDividendDate($fundamental_dragon[$i]->getJson()->DividendDate);
            $system_company[$i]->setExDividendDate($fundamental_dragon[$i]->getJson()->ExDividendDate);

            $this->doctrine->persist($system_company[$i]);
        }

        $this->doctrine->flush();
    }

    public function testOneCompany()
    {
        var_dump ('---one company---');
        $url = "https://www.alphavantage.co/query?function=OVERVIEW&symbol=IBM&apikey=WAII57B91ROAWB4K";
        $company = "AAPL";
        $aapl = new Instrument;

        $parser = new Parser("https://www.alphavantage.co/query?function=OVERVIEW&symbol=".$company."&apikey=WAII57B91ROAWB4K");

        //var_dump ($parser->getJson()->Symbol);die();

        ///$symbol = $parser->getJson()->Symbol;
        

        $aapl->setSymbol("AAPL");
        $aapl->setAssetType($parser->getJson()->AssetType);
        $aapl->setName($parser->getJson()->Name);
        $aapl->setDescription($parser->getJson()->Description);
        $aapl->setCIK($parser->getJson()->CIK);
        $aapl->setExchange($parser->getJson()->Exchange);
        $aapl->setCurrency($parser->getJson()->Currency);
        $aapl->setCountry($parser->getJson()->Country);
        $aapl->setSector($parser->getJson()->Sector);
        $aapl->setIndustry($parser->getJson()->Industry);
        $aapl->setAddress($parser->getJson()->Address);
        $aapl->setFiscalYearEnd($parser->getJson()->FiscalYearEnd);
        $aapl->setLatestQuarter($parser->getJson()->LatestQuarter);
        $aapl->setMarketCapitalization($parser->getJson()->MarketCapitalization);
        $aapl->setEBITDA($parser->getJson()->EBITDA);
        $aapl->setPERatio($parser->getJson()->PERatio);
        $aapl->setBookValue($parser->getJson()->BookValue);
        $aapl->setDividendPerShare($parser->getJson()->DividendPerShare);
        $aapl->setDividendYield($parser->getJson()->DividendYield);
        $aapl->setEPS($parser->getJson()->EPS);
        $aapl->setRevenuePerShareTTM($parser->getJson()->RevenuePerShareTTM);
        $aapl->setProfitMargin($parser->getJson()->ProfitMargin);
        $aapl->setOperatingMarginTTM($parser->getJson()->OperatingMarginTTM);
        $aapl->setReturnOnAssetsTTM($parser->getJson()->ReturnOnAssetsTTM);
        $aapl->setReturnOnEquityTTM($parser->getJson()->ReturnOnEquityTTM);
        $aapl->setRevenueTTM($parser->getJson()->RevenueTTM);
        $aapl->setGrossProfitTTM($parser->getJson()->GrossProfitTTM);
        $aapl->setDilutedEPSTTM($parser->getJson()->DilutedEPSTTM);
        $aapl->setQuarterlyEarningsGrowthYOY($parser->getJson()->QuarterlyEarningsGrowthYOY);
        $aapl->setQuarterlyRevenueGrowthYOY($parser->getJson()->QuarterlyRevenueGrowthYOY);
        $aapl->setAnalystTargetPrice($parser->getJson()->AnalystTargetPrice);
        $aapl->setTrailingPE($parser->getJson()->TrailingPE);
        $aapl->setForwardPE($parser->getJson()->ForwardPE);
        $aapl->setPriceToSalesRatioTTM($parser->getJson()->PriceToSalesRatioTTM);
        $aapl->setPriceToBookRatio($parser->getJson()->PriceToBookRatio);
        $aapl->setEVToRevenue($parser->getJson()->EVToRevenue);
        $aapl->setEVToEBITDA($parser->getJson()->EVToEBITDA);
        $aapl->setBeta($parser->getJson()->Beta);
        ///$aapl->setW52WeekHigh($parser->getJson()->52WeekHigh);
        ///$aapl->setW52WeekLow($parser->getJson()->52WeekLow);
        ///$aapl->setM50MDayMovingAverage($parser->getJson()->50DayMovingAverage);
        ///$aapl->setM200DayMovingAverage($parser->getJson()->200DayMovingAverage);
        $aapl->setSharesOutstanding($parser->getJson()->SharesOutstanding);
        $aapl->setDividendDate((float)$parser->getJson()->DividendDate);
        $aapl->setExDividendDate((float)$parser->getJson()->ExDividendDate);

        var_dump ($aapl);
 
        $this->doctrine->persist($aapl);
        $this->doctrine->flush();
    }
}
