<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Service\Queues;

class HackerTest  extends KernelTestCase
{
    /**
    * @var EntityManagerInterface
    */
    protected  $doctrine;

    /**
    * @var Queues
    */
    protected $queues;

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->queues = static::$kernel->getContainer()->get(Queues::class);
    }

    public function testAvadaKedavra()
    {
        var_dump ('---avada kedavra---');
        $system = [];

        $instance = $this->queues->getInstance($system);

        $instance->push(101001);
        $instance->push(1001);
        $instance->push(1);
        $instance->push(11001);
        $instance->push(1994001001);

        $info = $this->merge_sort($instance->getSystem());
        var_dump ($info);
    }

    public function merge_sort($system)
    {
        if (count($system) == 1) return $system;

        $left = array_slice($system, 0, count($system) / 2);
        $right = array_slice($system, count($system) / 2);

        $left = $this->merge_sort($left);
        $right = $this->merge_sort($right);

        return $this->merge($left, $right);
    }

    public function merge($left, $right): ?array
    {
        $slice = [];
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] > $right[0]) {
                $slice[] = $right[0];
                $right = array_slice($right, 1);
            }
            else {
                $slice[] = $left[0];
                $left = array_slice($left, 1);
            }
        }

        while (count($left) > 0) {
            $slice[] = $left[0];
            $left = array_slice($left, 1);
        }

        while (count($right) > 0) {
            $slice[] = $right[0];
            $right = array_slice($right, 1);
        }

        return $slice ?: NULL;
    }
}
