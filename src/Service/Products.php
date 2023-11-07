<?php  

namespace App\Service;

use App\Entity\Product;

class Products
{
    public function getInstance(): Product
    {
        $instance = new Product;
        return $instance;
    }
}
