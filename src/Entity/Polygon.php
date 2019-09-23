<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Point;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PolygonRepository")
 */
class Polygon
{
    public $vertices = [];
    public $width;

    public function __construct($vertices) {
        $this->vertices = $vertices;
        $this->calculateWidth();
    }

    public function getVertices()
    {
        return $this->vertices;
    }

    public function setVertices(array $vertices)
    {
        $this->vertices = $vertices;
        $this->calculateWidth();
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function calculateWidth()
    {
        $temp_width = 0;

        for ($i=0; $i < count($this->vertices); $i++) {
            if ($i === 1 && count($this->vertices) === 2) {
                break;
            } else if ($i + 1 >= count($this->vertices)) {
                $temp_width += Point::distance($this->vertices[$i], $this->vertices[0]);
            } else {
                $temp_width += Point::distance($this->vertices[$i], $this->vertices[$i+1]);
            }
        }

        $this->width = round($temp_width, 3);
    }
}
