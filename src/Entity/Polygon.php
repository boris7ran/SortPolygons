<?php

namespace App\Entity;

use JsonSerializable;
use App\Exceptions\PolygonException;

class Polygon implements JsonSerializable
{
    private $vertices = [];
    private $width;

    /**
     * Polygon constructor.
     * @param Point[] $vertices
     * @throws PolygonException
     */
    public function __construct($vertices)
    {
        if (count($vertices) < 3) {

            throw new PolygonException("Polygon cannot be defined with less than 3 vertices");
        }

        if ($this->checkForDuplicatePoints($vertices)) {
            $this->vertices = $vertices;
            $this->calculateWidth();
        } else {

            throw new PolygonException("Polygon cannot have multiple same points");
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
        $tempWidth = 0;

        for ($i = 0; $i < count($this->vertices); $i++) {
            if ($i === 1 && count($this->vertices) === 2) {
                break;
            } else if ($i + 1 >= count($this->vertices)) {
                $tempWidth += Point::distance($this->vertices[$i], $this->vertices[0]);
            } else {
                $tempWidth += Point::distance($this->vertices[$i], $this->vertices[$i + 1]);
            }
        }

        $this->width = round($tempWidth, 3);
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
