<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Command\SortPolygonCommand;
use Symfony\Component\Console\Application;


$application = new Application();

$sort = new SortPolygonCommand();

$application->add($sort);

$application->run();
