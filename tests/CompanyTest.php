<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\MSFT;
use App\Entity\Note;
use App\Service\Notes;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class CompanyTest extends KernelTestCase
{
    /**
    * @var EntityManagerInterface 
    */
    protected $doctrine;

    /**
    * @var Note
    */
    protected $note;

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->note = static::$kernel->getContainer()->get(Notes::class)->getInstance();
    }

    public function zjltestAvadaKedavra()
    {
        /// достать запись касаемую майкрософт
        $qm = $this->doctrine->createQueryBuilder();
        $need_info = "%майкрософт%";
        $qm
            ->select('note')
            ->from(Note::class, 'note')
            ->where(
                $qm->expr()->like('note.info', ':need_info')
            )
            ->setParameter('need_info', $need_info);
        $search_company = $qm->getQuery()->getResult();

        $handle_string = [];
        
        foreach ($search_company as $company) {
            $handle_string[] = $company->getInfo();
        }

        $need = $handle_string[0];
        var_dump ($need);
        
        $sys = explode(' ', $need);
        $grab = [];
        
        foreach ($sys as $s) {
            if (is_numeric($s)) {
                $grab[] = $s;
            }
        }

        var_dump ($grab);
        
    }

    public function xyxtestAvadaKedavra()
    {
        var_dump ('---avada kedavra--');
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('msft')
            ->from(MSFT::class, 'msft');
        $msft = $qm->getQuery()->getResult();
        $vol = [];

        foreach ($msft as $company) {
            $vol[] = $company->getVolume();
        }

        $info = $this->merge_sort($vol);
        var_dump ($info[count($info) - 1]);

        /// хочу записать в книгу интересных записей трейдера наибольшее значение для объема майкрософт
        $trader_info = "У компании майкрософт наибольший объем в исследуемом времени - " . $info[count($info) - 1];
        $this->note->setInfo($trader_info);
        $this->doctrine->persist($this->note);
        $this->doctrine->flush();
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

        return $res ?: NULL;
    }

    public function llitestAvadaKedavra()
    {
        var_dump ('---msft between five month---');
        /// вообще найди цены компании месяц назад
        $qm = $this->doctrine->createQueryBuilder();
        $time = Carbon::create(2022, 1, 1);
        //var_dump ($time);

        $look = CarbonImmutable::now();
        var_dump ($look);
    }

    public function ljptestAvadaKedavra()
    {
        //// найти все цены, которые выше средней цены и оставить только их
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('msft')
            ->from(MSFT::class, 'msft');
        $msft = $qm->getQuery()->getResult();
        $price_close = [];
        foreach ($msft as $company) {
            $price_close[] = $company->getClosePrice();
        }

        $bprice = $this->bubble_sort($price_close);

        $average = array_sum($bprice) / count($bprice) - 1;

        $max_price = max($bprice); 

        $only_high_price = [];
        $only_high_price = array_filter($bprice, function ($element) use ($average) {
            return $element > $average;
        });

        var_dump (count($only_high_price));
    }

    public function bubble_sort($sys): ?array
    {
        for ($i = 0; $i < count($sys); $i++) {
            for ($l = 0; $l < count($sys) - 1; $l++) {
                if ($sys[$l] > $sys[$l+1]) {
                    $temp = $sys[$l+1];
                    $sys[$l+1] = $sys[$l];
                    $sys[$l] = $temp;
                }
            }
        }
        return $sys ?: null;
    }

    public function testAvadaKedavra()
    {
        $look = 10000;
        $info = 1000;

        $result = $look <=> $info;
        var_dump ($result);

        $system = [
            'jacke' => 'diamonds',
            'queen' => 'hearts',
            'jacke' => 'black and whorsees',
            'king' => 'diamonds',
            'jacke' => 'something else from jacke...',
            'dolly' => 'spades'
        ];

        $only_jacke = [];

    }
}
