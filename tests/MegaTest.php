<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Service\Queues;
use App\Entity\Customer;
use App\Entity\Account;
use App\Entity\Employee;
use App\Entity\Department;
use Doctrine\ORM\Query\Expr\Join;
use Carbon\Carbon;

class MegaTest extends KernelTestCase
{
    /**
    * @var EntityManagerInterface 
    */
    protected $doctrine;

    /**
    * @var Queue
    */
    protected $queue;

    public $system = [];

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->queue = static::$kernel->getContainer()->get(Queues::class)->getInstance($this->system);
    }

    public function ytestAvadaKedavra()
    {
        var_dump ('---avada kedavra---');

        $this->queue->push(1010003);
        $this->queue->push(101000);
        $this->queue->push(101);
        $this->queue->push(1);
        $this->queue->push(1013);
        $this->queue->push(101490003);

        //$info = $this->merge_sort($this->queue->getSystem());
        //$bubble = $this->bubble_sort($this->queue->getSystem());
        //var_dump ($bubble);

        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('c')
            ->from(Customer::class, 'c');

        $who = $spell->getQuery()->getResult();
        var_dump ($who);
    }

    public function merge_sort($src)
    {
        if (count($src) == 1) return $src;

        $left = array_slice($src, 0, count($src) / 2);
        $right = array_slice($src, count($src) / 2);

        $left = $this->merge_sort($left);
        $right = $this->merge_sort($right);

        return $this->merge($left, $right);
    }

    public function merge($left, $right) : ?array
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

    public function bubble_sort($sys): ?array
    {
        for ($i = 0; $i < count($sys); $i++) {
            for ($y = 0; $y < count($sys) - 1; $y++) {
                if ($sys[$y] > $sys[$y+1]) {
                    $temp = $sys[$y+1];
                    $sys[$y+1] = $sys[$y];
                    $sys[$y] = $temp;
                }
            }
        }
        
        return $sys ?: NULL;
    }

    public function notworktestAvadaKedavra()
    {
        var_dump ('---avada kedavra---');

        /// обнаружить всех работников департамента - я знаю что у Операторов только один работник это Сюзан

        $department_number = 3;
        
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            //->select('e.id', 'e.fname', 'e.lname', 'd.name AS dname')
            ->select('e')
            ->from(Employee::class, 'e')
            ->innerJoin(Department::class, 'd', 'WITH', 'd.id=e.department_id')
            ->setParameter('info', $department_number);

        $look = $spell->getQuery();
        //var_dump ($look);die();


        $infospell = $spell->getQuery()->getResult();

        echo "\n";

        foreach ($infospell as $employee) {
            echo $employee->getFname();
            echo "\n";
        }
    }

    public function yytestInfo()
    {
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('e', 'd')
            ->from(Employee::class, 'e')
            ->innerJoin('e.department', 'd', 'WITH', 'e.department = d.id');
        ///->where('d.id = 1');

        $craft = $spell->getQuery()->getResult();
        //var_dump ($craft[0]->getFname());
        var_dump (count($craft));
    }

    public function ltestTest()
    {
        $spell = $this->doctrine->createQueryBuilder();
        $title = 'President';
        $spell
            ->select('e')
            ->from(Employee::class, 'e')
            ->where(
                $spell->expr()->andX(
                    $spell->expr()->eq('e.title', ':title'),
                    $spell->expr()->lte('e.start_date', ':date')
                )
            )
            ->setParameter('title', $title)
            ->setParameter('date', Carbon::now());

        $craft = $spell->getQuery()->getResult();
        var_dump ($craft);
    }

    public function ljtestInfoGo()
    {
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('e.id', 'e.fname', 'e.lname', 'e.start_date', 'e.title')
            ->from(Employee::class, 'e')
            ->where(
                $spell->expr()->orX(
                    $spell->expr()->andX(
                        $spell->expr()->eq('e.title', ':title1'),
                        $spell->expr()->gt('e.start_date', ':date1')
                    ),
                    $spell->expr()->andX(
                        $spell->expr()->eq('e.title', ':title2'),
                        $spell->expr()->gt('e.start_date', ':date2')
                    )
                )
            )
            ->setParameter('title1', 'President')
            ->setParameter('date1', '2002-01-01')
            ->setParameter('title2', 'Treasurer')
            ->setParameter('date2', '2003-01-01');

        $go = $spell->getQuery()->getResult();
        var_dump ($go);
                                                      
    }

    public function interesting($one, $two)
    {
        return $one + $two;
    }

    public function xtestAvadaKedavrax()
    {
        var_dump ('---avada kedavra---');

        $system = [
            1, 2, 3, 4, 5
        ];
        $info = array_reduce($system, function ($one, $two) {
            return $this->interesting($one, $two);
        }, 0);

        var_dump ($info);
    }

    public function correlationCoefficient($x, $y)
    {
        $n = count($x);
        $meanX = array_reduce($x, function ($carry, $item) {
            return $carry + $item;
        }) / $n;
        $meanY = array_reduce($y, function ($carry, $item) {
            return $carry + $item;;
        }) / $n;

        $numerator = array_reduce(range(0, $n-1), function ($carry, $i) use ($x, $y, $meanX, $meanY) {
            return $carry + (($x[$i] - $meanX) * ($y[$i] - $meanY));
        });

        $denominatorX = sqrt(array_reduce($x, function ($carry, $item) use ($meanX) {
            return $carry = pow(($item - $meanX), 2);
        }));

        $denominatorY = sqrt(array_reduce($y, function($carry, $item) use ($meanY) {
            return $carry + pow(($item - $meanY), 2);
        }));

        return $numerator / ($denominatorX * $denominatorY);
    }

    public function createMultiplier($factor)
    {
        return function ($number) use ($factor) {
            return $number * $factor;
        };
    }
    
    public function testCoefficient()
    {
        $x = [1, 2, 3, 4, 5];
        $y = [2, 4, 6, 8, 10];

        //$info = $this->correlationCoefficient($x, $y);
        //var_dump ($info);
        
        $double = $this->createMultiplier(2);
        $triple = $this->createMultiplier(3);

        //var_dump ($double(5));
        //var_dump ($triple(7));

        $sys = [
            'Jacke Diamonds, jacke@diamonds.com, 123-456-7890',
            'Queen Hearts, queen@hearts.com, 987-654-3210'
        ];

        //$info = implode(', ', $sys);
        //var_dump (explode(', ', $info));

        $info = array_walk($x, function (&$value, $key) { $value *= 2;});
        var_dump ($x);
    }
}
