<?php

namespace Base10;

class Car
{
    public $name;
    public $age;

    public function road1(): void
    {
        echo "Jalan Soekarno";
    }

    public function road2(): void
    {
        echo "Jalan Kamal Raya";
    }

    public function tampil(int $age): void
    {
        $this->age = $age;

        echo "name: $this->name";

        echo "age: $this->age";
    }
}

$car = new Car();
$car->road2();

echo "<br>";

$car->name = "luminus";
$car->tampil(17);
