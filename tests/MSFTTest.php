<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\MSFT;


class MSFTTest extends KernelTestCase
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

    public function xxytestAvadaKedavra()
    {
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('msft')
            ->from(MSFT::class, 'msft');
        $msft = $qm->getQuery()->getResult();
        $price_open = [];
        
        foreach ($msft as $company) {
            $price_open[] = $company->getOpenPrice();
        }

        $volatility = [];
        
        /// найти среднюю волатильность
        for ($i = 0; $i < count($price_open)-1; $i++) {
            $volatility[] = $price_open[$i+1] / $price_open[$i];
        }

        $volatility = $this->searchVolatility($price_open);
        var_dump ($volatility);
        ///double(0.0010498094282426)
    }

    public function xyltestAvadaKedavra()
    {
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('msft')
            ->from(MSFT::class, 'msft');
        $handlePrice = 0;

        $update = $this->doctrine->createQueryBuilder();
        $update
            ->update(MSFT::class, 'msft')
            ->set('msft.typeChange', ':typeChange')
            ->where('msft.close_price', ':valuePrice')
            ->setParameter('typeChange', MSFT::TYPE_CHANGE_LEVEL)
            ->setParameter('valuePrice', $handlePrice);

        $price_close = [];
        
        $msft = $qm->getQuery()->getResult();
        foreach ($msft as $company) {
            $price_close[] = $company->getClosePrice();
        }

        //var_dump ($price_close);

        $catch_entity = [];

        for ($i = 0; $i < count($price_close) - 1; $i++) {
            if (abs($price_close[$i + 1] / $price_close[$i]) == 1) {
                $catch_entity[] = $this->doctrine->getRepository(MSFT::class)->findOneBy(['price_close' => $price_close[$i+1]]);
            }
        }

        var_dump ($catch_entity);
    }

    function searchVolatility($src)
    {
        $res = [];
        
        for ($i = 0; $i < count($src) - 1; $i++) {
            $res[] = ($src[$i+1] / $src[$i]) - 1;
        }

        return array_sum($res) / count($res) ?: NULL;
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
        while(count($left) > 0 && count($right) > 0) {
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
            $res[] = $left;
            $left = array_slice($left, 1);
        }

        while (count($right) > 0) {
            $res[] = $right;
            $right = array_slice($right, 1);
        }

        return $res ?: NULL;
    }

    public function bubble_sort($sys): ?array
    {
        for ($l = 0; $l < count($sys); $l++) {
            for ($i = 0; $i < count($sys) - 1; $i++) {
                if ($sys[$i] < $sys[$i+1]) {
                    $temp = $sys[$i+1];
                    $sys[$i+1] = $sys[$i];
                    $sys[$i] = $temp;
                }
            }
        }

        return $sys ?: NULL;
    }

    public function createLevel()
    {
        /// задача собрать всех у кого сегодняшняя цена на один доллар меньше чем вчерашняя - изменение один доллар и более
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('msft')
            ->from(MSFT::class, 'msft');

        $price_close = [];

        $msft = $qm->getQuery()->getResult();

        foreach ($msft as $company) {
            $price_close[] = $company->getClosePrice();
        }

        $level_price = [];
        /// собираю все у кого изменения за день меньше доллара
        for ($i = 0; $i < count($price_close) - 1; $i++) {
            if (abs($price_close[$i+1] - $price_close[$i]) < 0.5) {
                $level_price[] = $price_close[$i+1];
            }
        }

        ///var_dump ($level_price);
        //// теперь нужно все компании которые в уровень попали сделать там метку уровня
        $mark = $this->doctrine->createQueryBuilder();


        foreach ($level_price as $lprice) {
            $mark
                ->update(MSFT::class, 'msft')
                ->set('msft.typeChange', ':mark')
                ->where(
                    $mark->expr()->eq('msft.close_price', ':lprice')
                )
                ->setParameter('mark', MSFT::TYPE_CHANGE_LEVEL)
                ->setParameter('lprice', $lprice);
            $set_mark = $mark->getQuery()->getResult();
        }
        
    }
}
