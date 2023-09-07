<?php

declare(strict_types=1);

namespace Item\Quality;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class UpdateByNormalStrategyTest extends TestCase
{
    public function testDoubleDowngrading(): void
    {
        $items = [new Item('foo', 0, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testDowngrading(): void
    {
        $items = [new Item('foo', 1, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(1, $items[0]->quality);
    }

    public function testIfQualityEqualOneAndSellInIsNegative(): void
    {
        $items = [new Item('foo', 0, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }
}
