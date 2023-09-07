<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class SulfurasUpdateQuality implements UpdateQuality
{
    public function execute(Item $item): void
    {
        if ($item->quality !== 80) {
            $item->quality = 80;
        }
    }
}
