<?php

namespace App\Command;

use App\Services\ReadFileService;
use App\Services\SortPolygons;
use App\Services\SortPolygonsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SortPolygonCommand extends Command
{
    protected static $defaultName = 'app:sort-poly';

    protected function configure()
    {
        $this->addArgument('input-file', InputArgument::REQUIRED, 'Ulazni file');
        $this->addArgument('output-file', InputArgument::REQUIRED, 'Izlazni file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input_file = $input->getArgument('input-file');

        $rfs = new ReadFileService();
        $polys = $rfs->readFile($input_file);

        $sps = new SortPolygonsService();
        $polys = $sps->sortPolys($polys);

        $json_data = json_encode($polys);
        file_put_contents($input->getArgument('output-file'), $json_data);
    }
}