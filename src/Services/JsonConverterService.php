<?php

namespace App\Services;

use App\Entity\Point;
use App\Entity\Polygon;
use App\Interfaces\ConverterInterface;
use App\Exceptions\PolygonException;

class JsonConverterService implements ConverterInterface
{
    /**
     * @param $data
     * @return Polygon[] $polygons
     * @throws PolygonException
     */
    public function convertToPolygon($data)
    {
        $polygonsData = json_decode($data, true);
        $polygons = [];

        foreach ($polygonsData as $polygonData) {
            $points = [];

            foreach ($polygonData["vertices"] as $vertex) {
                $points[] = new Point($vertex["x"], $vertex["y"]);
            }

            $polygons[] = new Polygon($points);
        }

        return $polygons;
    }

    /**
     * @param Polygon[] $data
     * @return false|string
     */
    public function convertFromPolygon($data)
    {
        return json_encode($data);
    }
}