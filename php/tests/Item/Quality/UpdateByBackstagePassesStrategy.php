<?php

declare(strict_types=1);

namespace Item\Quality;

use GildedRose\Enum\ItemNamesEnum;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class UpdateByBackstagePassesStrategy extends TestCase
{
    public function testUpgrading(): void
    {
        $items = [new Item(ItemNamesEnum::BackstagePasses->value, 11, 48)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(49, $items[0]->quality);
    }

    public function testIncrementOfTwo(): void
    {
        $items = [
            new Item(ItemNamesEnum::BackstagePasses->value, 7, 10),
            new Item(ItemNamesEnum::BackstagePasses->value, 10, 10),
            new Item(ItemNamesEnum::BackstagePasses->value, 6, 10),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        foreach ($items as $item) {
            $this->assertSame(12, $item->quality);
        }
    }

    public function testIncrementOfThree(): void
    {
        $items = [
            new Item(ItemNamesEnum::BackstagePasses->value, 5, 10),
            new Item(ItemNamesEnum::BackstagePasses->value, 4, 10),
            new Item(ItemNamesEnum::BackstagePasses->value, 0, 10),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        foreach ($items as $item) {
            $this->assertSame(13, $item->quality);
        }
    }

    public function testWhenQualityIsAlwaysZero(): void
    {
        $items = [
            new Item(ItemNamesEnum::BackstagePasses->value, -5, 10),
            new Item(ItemNamesEnum::BackstagePasses->value, -1, 0),
            new Item(ItemNamesEnum::BackstagePasses->value, -1, 10),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        foreach ($items as $item) {
            $this->assertSame(0, $item->quality);
        }
    }
}
