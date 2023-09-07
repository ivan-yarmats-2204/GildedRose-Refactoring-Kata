<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class ConjuredUpdateQuality extends BaseUpdateQuality
{
    public function execute(Item $item): void
    {
        parent::execute($item);
        $item->quality = ($item->quality - 2) > 0 ? $item->quality - 2 : 0;
    }
}
