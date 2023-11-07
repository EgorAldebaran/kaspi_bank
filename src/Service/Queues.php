<?php  

namespace App\Service;

use App\Tools\Queue;

class Queues
{
    public function getInstance($src): Queue
    {
        $instance = new Queue($src);
        return $instance;
    }
}
