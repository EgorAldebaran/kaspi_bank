<?php  

namespace App\Service;

use App\Entity\ProductType;

class ProductTypes
{
    public function getInstance(): ProductType
    {
        $instance = new ProductType;
        return $instance;
    }
}
