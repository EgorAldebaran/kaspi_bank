<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\Instrument;
use App\Entity\T;

class FundamentalInfoTest extends KernelTestCase
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
    
    public function testInfo()
    {
        $t = $this->doctrine->getRepository(T::class)->findAll();
        $price_open = [];

        foreach ($t as $company) {
            $price_open[] = $company->getOpenPrice();
        }
        $max = max($price_open);

        $need = $this->doctrine->getRepository(T::class)->findOneBy(['openPrice' => $max]);
        
        //var_dump ($need);
        
        //var_dump ($max);
        
        //$info = $this->merge_sort($price_open);
        //var_dump ($info);

        $binfo = $this->bubble_sort($price_open);
        ///var_dump ($binfo);

        $symbol = 'T';

        $info = $this->doctrine->getRepository(Instrument::class)->findOneBy(['symbol' => $symbol]);
        var_dump ($info->getDescription());
    }

    public function merge_sort($sys)
    {
        if (count($sys) == 1) return $sys;

        $left = array_slice($sys, 0, count($sys) / 2);
        $right = array_slice($sys, count($sys) / 2);

        $left = $this->merge_sort($left);
        $right = $this->merge_sort($right);

        return $this->merge($left, $right);
    }

    public function merge($left, $right): ?array
    {
        $res = [];
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] > $right[0]) {
                $res[] = $right[0];
                $right = array_slice($right, 1);
            }
            else {
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }

        while (count($left) > 0) {
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }

        while (count($right) > 0) {
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }

        return $res ?: null;
    }

    public function bubble_sort($sys) : ?array
    {
        for ($i = 0; $i < count($sys); $i++) {
            for ($l = 0; $l < count($sys) - 1; $l++) {
                if ($sys[$l] < $sys[$l+1]) {
                    $temp = $sys[$l+1];
                    $sys[$l+1] = $sys[$l];
                    $sys[$l] = $temp;
                }
            }
        }

        return $sys ?: null;
    }


}
