<?php

declare(strict_types=1);

namespace GildedRose\Service;

use GildedRose\Enum\ItemNamesEnum;
use GildedRose\Exception\Item\Quality\GreaterAndEquelMaximumException;
use GildedRose\Exception\Item\Quality\LessAndEquelMinimumException;
use GildedRose\Item;
use GildedRose\Strategy\Item\UpdateQuality\AgedBrieUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\BackstagePassesUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\BaseUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\ConjuredUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\NormalUpdateQuality;
use GildedRose\Strategy\Item\UpdateQuality\SulfurasUpdateQuality;
use GildedRose\Strategy\Item\UpdateQualityContext;
use GildedRose\Validator\ItemQualityValidator;

class UpdateItemService
{
    public function updateForNextDayByStrategy(Item $item): void
    {
        $context = new UpdateQualityContext();
        try {
            ItemQualityValidator::validate($item);
            match ($item->name) {
                ItemNamesEnum::AgedBrie->value => $context->setStrategy(new AgedBrieUpdateQuality()),
                ItemNamesEnum::Conjured->value => $context->setStrategy(new ConjuredUpdateQuality()),
                ItemNamesEnum::Sulfuras->value => $context->setStrategy(new SulfurasUpdateQuality()),
                ItemNamesEnum::BackstagePasses->value => $context->setStrategy(new BackstagePassesUpdateQuality()),
                default => $context->setStrategy(new NormalUpdateQuality())
            };
        } catch (LessAndEquelMinimumException|GreaterAndEquelMaximumException) {
            if (ItemNamesEnum::Sulfuras->value === $item->name) {
                $context->setStrategy(new SulfurasUpdateQuality());
            } else {
                $context->setStrategy(new BaseUpdateQuality());
            }
        }

        $context->updateItemQuality($item);
        $item->sellIn--;
    }
}
