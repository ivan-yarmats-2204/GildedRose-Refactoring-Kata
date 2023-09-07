<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Item;

use GildedRose\Item;
use GildedRose\Strategy\Item\UpdateQuality\UpdateQuality;

class UpdateQualityContext
{
    private UpdateQuality $updateQuality;

    public function setStrategy(UpdateQuality $updateQuality): self
    {
        $this->updateQuality = $updateQuality;

        return $this;
    }

    public function updateItemQuality(Item $item): self
    {
        $this->updateQuality->execute($item);

        return $this;
    }
}
