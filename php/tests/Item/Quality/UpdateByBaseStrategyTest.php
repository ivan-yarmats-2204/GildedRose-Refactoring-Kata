<?php

declare(strict_types=1);

namespace Item\Quality;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class UpdateByBaseStrategyTest extends TestCase
{
    public function testIfQualityIsNegative(): void
    {
        $items = [new Item('foo', -1, -1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testIfQualityIsGreaterMaximum(): void
    {
        $items = [new Item('foo', 2, 60)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
    }
}
