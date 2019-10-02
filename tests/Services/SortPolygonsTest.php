<?php

namespace Tests\Services;

use App\Entity\Point;
use App\Entity\Polygon;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\TestCase;
use App\Services\PolygonsService;

class SortPolygonsTest extends TestCase
{
    public function testSortPolygonsTest()
    {
        $arr = [
            new Polygon([new Point(1, 2), new Point(3, 5), new Point(-1, 5), new Point(8, 9)]),
            new Polygon([new Point(4, 5), new Point(6, 7), new Point(-1, 2), new Point(4, 7)]),
            new Polygon([new Point(1, 2), new Point(3, 5), new Point(-1, 5)])
        ];

        $sps = new PolygonsService();
        $sorted = $sps->sortPolys($arr);

        $this->assertEquals(count($arr), count($sorted));
    }

    public function testArrayIsSortedTest()
    {
        $arr = [
            new Polygon([new Point(1, 2), new Point(3, 5), new Point(-1, 5), new Point(8, 9)]),
            new Polygon([new Point(111, 11), new Point(6, 7), new Point(-1, 2), new Point(4, 7)]),
            new Polygon([new Point(1, 2), new Point(3, 5), new Point(-1, 5)]),
            new Polygon([new Point(1, 2), new Point(3, 5), new Point(8, 5), new Point(11, 9)])
        ];

        $sps = new PolygonsService();
        $sorted = $sps->sortPolys($arr);

        $this->assertArrayIsSorted($sorted);
    }

    /**
     * @param Polygon[] $arr
     * @return IsFalse|IsTrue
     */
    public function assertArrayIsSorted($arr)
    {
        for ($i=0; $i < count($arr)-1; $i++) {
            $this->assertNotTrue($arr[$i]->getWidth() < $arr[$i+1]->getWidth(), "Array is not sorted");
        }
    }
}