<?php

namespace App\Tools;

class Queue
{
    /**
    * @var system body
    */
    protected $system_body;

    public function __construct($sys)  {
        $this->system_body = $sys;
    }

    public function getSystem(): ?array
    {
        return $this->system_body ?: NULL;
    }

    public function push($element)
    {
        array_push($this->system_body, $element);
    }

    public function isEmpty()
    {
        if ($this->system_body == NULL) {
            throw new \Exception('body cannot be empty');
        }

        return;
    }

    public function pop()
    {
        $this->isEmpty();
        array_pop($this->system_body);
    }
}
