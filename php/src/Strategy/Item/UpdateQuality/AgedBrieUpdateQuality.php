<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class AgedBrieUpdateQuality implements UpdateQuality
{
    public function execute(Item $item): void
    {
        if ($item->quality < 50) {
            ++$item->quality;
        }
    }
}
