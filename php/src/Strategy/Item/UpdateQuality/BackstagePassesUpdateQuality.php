<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

class BackstagePassesUpdateQuality extends BaseUpdateQuality
{
    public function execute(Item $item): void
    {
        parent::execute($item);
        if ($item->sellIn < 0) {
            $item->quality = 0;
        } else {
            if ($item->sellIn <= 5) {
                if (($item->quality + 3) >= 50) {
                    $item->quality = 50;
                } else {
                    $item->quality = $item->quality + 3;
                }
            } elseif ($item->sellIn <= 10) {
                if (($item->quality + 2) >= 50) {
                    $item->quality = 50;
                } else {
                    $item->quality = $item->quality + 2;
                }
            } else {
                $item->quality = $item->quality + 1;
            }
        }
    }
}
