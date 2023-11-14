<?php  

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Service\Queues;

class LookTest extends KernelTestCase
{
    /**
    * @var Queue
    */
    protected $queue;

    /**
    * @var System body
    */
    protected $system = [];

    public function setUp(): void
    {
        static::bootKernel();
        $this->queue = static::$kernel->getContainer()->get(Queues::class)->getInstance($this->system);
    }

    public function testAvadaKedavra()
    {
        $this->queue->push(1001);
        $this->queue->push(1080);
        $this->queue->push(10);
        $this->queue->push(10448);
        $this->queue->push(1494);

        $info = $this->merge_sort($this->queue->getSystem());
        //var_dump ($info);

        $binfo = $this->bubble_sort($this->queue->getSystem());
        //var_dump ($binfo);

        $iinfo = $this->insertion_sort($this->queue->getSystem());
        var_dump ($iinfo);

        //$this->assertEquals($binfo[0], 10);
        $this->assertEquals($info[0], 10);
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
        return $sys ?: NULL;
    }

    public function insertion_sort($sys): ?array
    {
        for ($i = 1; $i < count($sys); $i++) {
            $key = $sys[$i];
            $l = $i - 1;
            while ($l >= 0 && $sys[$l] > $key) {
                $sys[$l + 1] = $sys[$l];
                $l = $l - 1;
            }

            $sys[$l + 1] = $key;
        }

        return $sys;
    }
}
