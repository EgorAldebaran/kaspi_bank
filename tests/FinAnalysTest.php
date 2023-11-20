<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Parser\Parser;

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

    public function testAvadaKedavra()
    {
        $url = 'https://www.gnu.org';
        $parser = new Parser($url);
        var_dump ($parser);
    }
}
