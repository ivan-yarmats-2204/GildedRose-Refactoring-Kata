<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Service\UpdateItemService;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items,
    ) {
    }

    public function updateQuality(): void
    {
        $itemService = new UpdateItemService();
        foreach ($this->items as $item) {
            $itemService->updateForNextDayByStrategy($item);
        }
    }
}
