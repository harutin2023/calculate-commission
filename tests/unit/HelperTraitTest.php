<?php

namespace App\Tests;

use App\Traits\HelperTrait;
use PHPUnit\Framework\TestCase;

class HelperTraitTest extends TestCase
{
    use HelperTrait;
    /**
     * @dataProvider dataProvider
     * @param float $before
     * @param float $expected
    */
    public function testCeil(float $before, float $expected)
    {
        $this->assertSame($this->ceil($before, 2), $expected);
    }

    public static function dataProvider(): array
    {
        return [
            [0.58145, 0.59],
            [0.31227, 0.32],
            [0.68457, 0.69],
            [0.89001, 0.9]
        ];
    }
}