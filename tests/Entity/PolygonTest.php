<?php

namespace Tests\Services;

use App\Entity\Point;
use PHPUnit\Framework\TestCase;
use App\Entity\Polygon;
use \Exception;

class PolygonTest extends TestCase
{
    /**
     * @dataProvider polygonProvider
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
        } catch (Exception $e) {
            $this->assertEquals("Polygon cant be defined with less than 3 vertices", $e->getMessage());
        }
    }

    /**
     * @expectedException Exception
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

        } catch (Exception $e) {
            $this->assertEquals("Polygon cant have multiple same points", $e->getMessage());
        }
    }

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