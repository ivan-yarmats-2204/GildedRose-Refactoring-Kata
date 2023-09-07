<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class ConjuredUpdateQuality implements UpdateQuality
{
    public function execute(Item $item): void
    {
        $item->quality = ($item->quality - 2) > 0 ? $item->quality - 2 : 0;
    }
}
