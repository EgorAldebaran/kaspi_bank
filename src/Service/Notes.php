<?php  

namespace App\Service;

use App\Entity\Note;

class Notes
{
    public function getInstance(): Note
    {
        $instance = new Note;
        return $instance;
    }
}
