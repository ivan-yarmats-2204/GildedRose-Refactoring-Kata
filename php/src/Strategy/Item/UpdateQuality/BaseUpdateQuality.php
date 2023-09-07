<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

abstract class BaseUpdateQuality implements UpdateQuality
{
    public function execute(Item $item): void
    {
        if ($item->quality > 50) {
            $item->quality = 50;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}
