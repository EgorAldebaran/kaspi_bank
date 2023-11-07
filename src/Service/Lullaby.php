<?php  

namespace App\Service;

use App\Entity\Person;

class Lullaby
{
    public function getInstance(): ?Person
    {
        $instance = new Person;
        return $instance ?: NULL;
    }
}
