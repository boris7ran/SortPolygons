<?php

namespace App\Command;

use App\Exceptions\PolygonException;
use App\Services\JsonConverterService;
use App\Services\JsonFileService;
use App\Services\PolygonsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SortPolygonCommand extends Command
{
    protected static $defaultName = 'app:sort-poly';

    protected function configure()
    {
        $this->addArgument('inputFile', InputArgument::REQUIRED, 'Ulazni file');
        $this->addArgument('outputFile', InputArgument::REQUIRED, 'Izlazni file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws PolygonException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $jfs = new JsonFileService(new JsonConverterService());
        $polys = $jfs->loadRepo($input->getArgument('inputFile'));

        $polyService = new PolygonsService();
        $polysSorted = $polyService->sortPolys($polys);

        $jfs->saveToRepo($input->getArgument('outputFile'), $polysSorted);
    }
}