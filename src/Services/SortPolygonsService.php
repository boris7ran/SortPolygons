<?php

namespace App\Services;

use App\Entity\Polygon;

class SortPolygonsService
{
    /**
     * @param $polygons
     * @return Polygon[] $polygons
     */
    public function sortPolys($polygons)
    {
        if (count($polygons) < 2) {

            return $polygons;
        } else {
            for ($i = 0; $i < count($polygons) - 1; $i++) {
                for ($j = $i + 1; $j < count($polygons); $j++) {
                    if ($polygons[$i]->getWidth() < $polygons[$j]->getWidth()) {
                        $temp_poly = $polygons[$i];
                        $polygons[$i] = $polygons[$j];
                        $polygons[$j] = $temp_poly;
                    }
                }
            }
        }

        return $polygons;
    }
}