<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class NormalUpdateQuality implements UpdateQuality
{
    public function execute(Item $item): void
    {
        if ($item->quality > 0) {
            if ($item->sellIn <= 0) {
                if (($item->quality - 2) <= 0) {
                    $item->quality = 0;
                } else {
                    $item->quality = $item->quality - 2;
                }
            } else {
                $item->quality = $item->quality - 1;
            }
        }
    }
}
