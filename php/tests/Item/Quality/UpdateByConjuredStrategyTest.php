<?php

declare(strict_types=1);

namespace Item\Quality;

use GildedRose\Enum\ItemNamesEnum;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class UpdateByConjuredStrategyTest extends TestCase
{
    public function testDoubleDowngrading(): void
    {
        $items = [
            new Item(ItemNamesEnum::Conjured->value, 2, 10),
            new Item(ItemNamesEnum::Conjured->value, 0, 10),
            new Item(ItemNamesEnum::Conjured->value, -1, 10),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        foreach ($items as $item) {
            $this->assertSame(8, $item->quality);
        }
    }
}
