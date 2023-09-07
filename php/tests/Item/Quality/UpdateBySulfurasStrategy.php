<?php

declare(strict_types=1);

namespace Item\Quality;

use GildedRose\Enum\ItemNamesEnum;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class UpdateBySulfurasStrategy extends TestCase
{
    public function testQualityEqualOnlyConstant(): void
    {
        $items = [
            new Item(ItemNamesEnum::Sulfuras->value, -1, -60),
            new Item(ItemNamesEnum::Sulfuras->value, 0, -60),
            new Item(ItemNamesEnum::Sulfuras->value, -1, 50),
            new Item(ItemNamesEnum::Sulfuras->value, 0, 50),
            new Item(ItemNamesEnum::Sulfuras->value, 0, 120),
            new Item(ItemNamesEnum::Sulfuras->value, 0, 80),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        foreach ($items as $item) {
            $this->assertSame(80, $item->quality);
        }
    }
}
