<?php

namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ReadFileService;
use Exception;

class ReadFileTest extends TestCase
{
    /**
     * @dataProvider filesProvider
     */
    public function testReadFileWithNoFile($input_file)
    {
        $rfs = new ReadFileService();

        try {
            $polys = $rfs->readFile($input_file);
            $this->assertNotNull($polys);
        } catch (Exception $e) {
            $this->assertEquals("The file $input_file doesnt exist", $e->getMessage());
        }
    }

    public function filesProvider()
    {
        return [["pol.json"], ["soly.json"], ["gori.yaml"], ["ivan"]];
    }
}