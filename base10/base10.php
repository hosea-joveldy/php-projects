<?php

namespace Base10;

class Car
{
    public function road1(): void
    {
        echo "Jalan Soekarno";
    }

    public function road2(): void
    {
        echo "Jalan Kamal Raya";
    }
}

$car = new Car();
$car->road2();
