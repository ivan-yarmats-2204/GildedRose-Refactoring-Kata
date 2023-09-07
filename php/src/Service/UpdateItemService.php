<?php

declare(strict_types=1);

namespace GildedRose\Service;

use GildedRose\Enum\ItemNamesEnum;
use GildedRose\Item;
use GildedRose\Strategy\Item\UpdateQuality\AgedBrieUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\BackstagePassesUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\ConjuredUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\NormalUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\SulfurasUpdateQuality;
use GildedRose\Strategy\Item\UpdateQualityContext;

class UpdateItemService
{
    public function updateForNextDayByStrategy(Item $item): void
    {
        $context = new UpdateQualityContext();
        match ($item->name) {
            ItemNamesEnum::AgedBrie->value => $context->setStrategy(new AgedBrieUpdateQuality()),
            ItemNamesEnum::Conjured->value => $context->setStrategy(new ConjuredUpdateQuality()),
            ItemNamesEnum::Sulfuras->value => $context->setStrategy(new SulfurasUpdateQuality()),
            ItemNamesEnum::BackstagePasses->value => $context->setStrategy(new BackstagePassesUpdateQuality()),
            default => $context->setStrategy(new NormalUpdateQuality())
        };

        $context->updateItemQuality($item);
        $item->sellIn--;
    }
}
