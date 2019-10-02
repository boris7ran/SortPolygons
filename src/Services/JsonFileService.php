<?php

namespace App\Services;

use App\Entity\Polygon;
use App\Exceptions\PolygonException;
use App\Interfaces\RepoInterface;

class JsonFileService implements RepoInterface
{
    private $converter;

    public function __construct($converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param $input
     * @return Polygon[]
     * @throws PolygonException
     */
    public function loadRepo($input)
    {
        if (!file_exists($input)) {
            throw new PolygonException("The file $input does not exist");
        }

        $data = file_get_contents($input);

        return $this->converter->convertToPolygon($data);
    }

    /**
     * @param string $output
     * @param Polygon[] $data
     */
    public function saveToRepo($output, $data)
    {
        file_put_contents($output, $this->converter->convertFromPolygon($data));
    }
}