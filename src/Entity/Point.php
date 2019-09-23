<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Point
{

    public $x;
    public $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public static function distance($point1, $point2)
    {
        return sqrt(pow($point2->y - $point1->y, 2) + pow($point2->x - $point1->y, 2));
    }
}
