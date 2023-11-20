<?php  

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;

class Trade
{
    public $instrument;
    public $price;
    public $quantity;
    public $date;

    public function __construct($data)  {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
