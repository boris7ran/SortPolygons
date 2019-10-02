<?php

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\JsonFileService;
use App\Services\JsonConverterService;
use App\Exceptions\PolygonException;

class ReadFileTest extends TestCase
{
    /**
     * @dataProvider filesProvider
     * @param $inputFile
     */
    public function testReadFileWithNoFile($inputFile)
    {
        $jfs = new JsonFileService(new JsonConverterService());

        try {
            $polys = $jfs->loadRepo($inputFile);
            $this->assertNotNull($polys);
        } catch (PolygonException $e) {
            $this->assertEquals("The file $inputFile does not exist", $e->getMessage());
        }
    }

    public function filesProvider()
    {
        return [["pol.json"], ["soly.json"], ["gori.yaml"], ["ivan"]];
    }
}