<?php

namespace App\Services;

use App\Entity\Point;
use App\Entity\Polygon;
use App\Exceptions\MyException;

class ReadFileService
{
    /**
     * @param string $input_file
     * @return array
     */
    public function readFile($input_file)
    {
        if (!file_exists($input_file)) {

            throw new MyException("The file $input_file doesnt exist");
        } else {
            $json = file_get_contents($input_file);
            $json_data = json_decode($json, true);
            $polygons = [];

            foreach ($json_data as $key1 => $value1) {
                $point_array = [];

                foreach ($value1["vertices"] as $vertex) {
                    $temp_point = new Point($vertex["x"], $vertex["y"]);
                    array_push($point_array, $temp_point);
                }

                $temp_poly = new Polygon($point_array);
                array_push($polygons, $temp_poly);
            }

            return $polygons;
        }
    }
}