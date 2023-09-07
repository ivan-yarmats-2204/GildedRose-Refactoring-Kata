<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item\UpdateQuality;

use GildedRose\Item;

interface UpdateQuality
{
    public function execute(Item $item): void;
}
