<?php

namespace Tests\Services;

use App\Entity\Point;
use PHPUnit\Framework\TestCase;
use App\Entity\Polygon;
use App\Exceptions\PolygonException;

class PolygonTest extends TestCase
{
    /**
     * @dataProvider polygonProvider
     * @param [] $vertices
     * @param bool $case
     */

    public function testPolygonConstructionWithCatchTest($vertices, $case)
    {
        try {
            $poly = new Polygon($vertices);

            if ($case) {
                $this->assertNotNull($poly);
            } else {
                $this->assertNull($poly);
            }
        } catch (PolygonException $e) {
            $this->assertEquals("Polygon cannot be defined with less than 3 vertices", $e->getMessage());
        }
    }

    /**
     * @expectedException PolygonException
     * @expectedExceptionMessage Polygon cant be defined with less than 3 vertices
     * @dataProvider polygonProvider
     */
    public function testPolygonConstructionWithErrorExpectedTest($vertices, $case)
    {
        $poly = new Polygon($vertices);

        if ($case) {
            $this->assertNotNull($poly);
        } else {
            $this->assertNull($poly);
        }
    }

    /**
     * @dataProvider polygonWithSamePoints
     */
    public function testPolygonConstructionWithSamePoints($vertices, $case)
    {
        try {
            $poly = new Polygon($vertices);

            if ($case) {
                $this->assertNotNull($poly);
            } else {
                $this->assertNull($poly);
            }

        } catch (PolygonException $e) {
            $this->assertEquals("Polygon cannot have multiple same points", $e->getMessage());
        }
    }

    /**
     * @return array
     * @throws PolygonException
     */
    public function polygonProvider()
    {
        $arr = [
            [[new Point(1, 2), new Point(4, 5), new Point(3, 7)], true],
            [[new Point(5, 8), new Point(0, 0)], false],
            [[new Point(1, 1)], false],
            [[], false]
        ];

        return $arr;
    }

    /**
     * @return array
     * @throws PolygonException
     */
    public function polygonWithSamePoints()
    {
        $arr = [
            [[new Point(1, 2), new Point(5, 5), new Point(6, 6)], true],
            [[new Point(1, 2), new Point(4, 5), new Point(1, 2)], false],
            [[new Point(1, 5), new Point(1, 2), new Point(3, 7), new Point(1, 5)], false],
        ];

        return $arr;
    }
}