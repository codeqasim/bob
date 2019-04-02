<?php

class Guests
{
    public $adult;
    public $child;
    public $infant;

    public function __construct()
    {
        $this->adult = 1;
        $this->child = 0;
        $this->infant = 0;
    }

    public function total()
    {
        $totalPassengers = (int) $this->adult;
        $totalPassengers += (int) $this->child;
        $totalPassengers += (int) $this->infant;

        return $totalPassengers;
    }
}
