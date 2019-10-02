<?php

namespace Tests\Entity;

use App\Entity\Point;
use PHPUnit\Framework\TestCase;
use App\Exceptions\PolygonException;

class PointTest extends TestCase
{
    /**
     * @dataProvider coordinatesProvider
     */
    public function testPointArguments($x, $y)
    {
        try {
            $point = new Point($x, $y);
            $this->assertNotNull($point);
        } catch (PolygonException $e) {
            $this->assertEquals("Values are not integer", $e->getMessage());
        }
    }

    public function coordinatesProvider()
    {
        return [[1, 2], ["zivan", "jovan"], ["jovan", 5], [null, 3], [1.254, true]];
    }
}