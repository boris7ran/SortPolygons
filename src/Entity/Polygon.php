<?php

namespace App\Entity;

use App\Entity\Point;
use JsonSerializable;
use App\Exceptions\MyException;

class Polygon implements JsonSerializable
{
    private $vertices = [];
    private $width;

    /**
     * Polygon constructor.
     * @param Point[] $vertices
     */
    public function __construct($vertices)
    {
        if (count($vertices) < 3) {

            throw new MyException("Polygon cant be defined with less than 3 vertices");
        }

        if ($this->checkForDuplicatePoints($vertices)) {
            $this->vertices = $vertices;
            $this->calculateWidth();
        } else {

            throw new MyException("Polygon cant have multiple same points");
        }
    }

    /**
     * @return Point[]
     */
    public function getVertices()
    {
        return $this->vertices;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    private function calculateWidth()
    {
        $temp_width = 0;

        for ($i = 0; $i < count($this->vertices); $i++) {
            if ($i === 1 && count($this->vertices) === 2) {
                break;
            } else if ($i + 1 >= count($this->vertices)) {
                $temp_width += Point::distance($this->vertices[$i], $this->vertices[0]);
            } else {
                $temp_width += Point::distance($this->vertices[$i], $this->vertices[$i + 1]);
            }
        }

        $this->width = round($temp_width, 3);
    }

    /**
     * @param array $vertices
     * @return bool
     */
    private function checkForDuplicatePoints($vertices)
    {
        for ($i = 0; $i < count($vertices); $i++) {
            for ($j = $i + 1; $j < count($vertices); $j++) {
                if (Point::equals($vertices[$i], $vertices[$j])) {

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            "vertices" => $this->vertices,
            "width" => $this->width
        ];
    }
}
