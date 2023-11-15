<?php  

namespace App\Tests;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\MSFT;
use App\Entity\Note;
use App\Service\Notes;

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

    public function testAvadaKedavra()
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
}
