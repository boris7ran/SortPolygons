<?php

namespace App\Entity;

use JsonSerializable;
use \Exception;

class Point implements JsonSerializable
{

    private $x;
    private $y;

    /**
     * Point constructor.
     * @param integer $x
     * @param integer $y
     */
    public function __construct($x, $y) {
        if (!is_int($x) || !is_int($y)) {
            throw new Exception("Values arent integer");
        }

        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @param Point $point1
     * @param Point $point2
     * @return float
     */
    public static function distance($point1, $point2)
    {
        return sqrt(pow($point2->x - $point1->x, 2) + pow($point2->y - $point1->y, 2));
    }

    /**
     * @param Point $point1
     * @param Point $point2
     * @return bool
     */
    public static function equals($point1, $point2)
    {
        return $point1->x === $point2->x && $point1->y === $point2->y;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            "x" => $this->x,
            "y" => $this->y
        ];
    }
}
