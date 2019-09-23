<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\Polygon;
use App\Entity\Point;

class SortPolygonCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:sort-poly';

    protected function configure()
    {
        $this->addArgument('input-file', InputArgument::REQUIRED, 'Ulazni file');
        $this->addArgument('output-file', InputArgument::REQUIRED, 'Izlazni file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input_file = $input->getArgument('input-file');

        if (!file_exists($input_file)) {
            echo "The file $input_file doesnt exists";
        } else {
            $polys = $this->readFile($input_file);

            $polys = $this->sortPolys($polys);

            $json_data = json_encode($polys);
            file_put_contents($input->getArgument('output-file'), $json_data);
        }
    }

    function readFile($input_file)
    {
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
