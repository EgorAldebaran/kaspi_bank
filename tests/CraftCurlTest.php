<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;

class CraftCurlTest extends KernelTestCase
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

    public function yyytestAvadaKadavr()
    {
        var_dump ('---kadavr---');
        $curl = curl_init();

        $sys = [1, 2, 33, 4, 5, 49];
        $info = array_map(function ($value) {
            return $this->multiply($value);
        }, $sys);

        $info = [];

        foreach ($sys as $s) {
            $info[] = $this->multiply($s);
        }

        //var_dump ($info);

        $city = 'Ekibastus';
        $oblast = 'Pavlodar';
        $event = 'Go to nahyi';

        $game = [
            'city',
            'oblast'
        ];

        $info = compact('event', $game);
        var_dump ($info);

    }

    public function multiply($value)
    {
        return $value *= 2;
    }
    
    public function look($value)
    {
        return $value += 12;
    }

    public function myMethod($value)
    {
        return $value * 2;
    }
    
    public function cube($n)
    {
        return ($n * $n * $n);
    }

    public function testTrader()
    {
        $fname = 'Jacke';
        $lname = 'Diamonds';
        $email = 'jacke@diamonds.com';
        $status = 'ACTIVE';

        $user = [
            'fname', 'lname', 'email', 'status'
        ];

        $info = compact('email', $user);
        var_dump ($info);

    }
}

