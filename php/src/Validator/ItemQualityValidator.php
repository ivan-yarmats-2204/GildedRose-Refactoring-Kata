<?php

declare(strict_types=1);

namespace GildedRose\Validator;

use GildedRose\Exception\Item\Quality\GreaterAndEquelMaximumException;
use GildedRose\Exception\Item\Quality\LessAndEquelMinimumException;
use GildedRose\Item;

class ItemQualityValidator
{
    /**
     * @throws LessAndEquelMinimumException
     * @throws GreaterAndEquelMaximumException
     */
    public static function validate(Item $item): void
    {
        if ($item->quality >= 50) {
            throw new GreaterAndEquelMaximumException();
        }
        if ($item->quality <= 0) {
            throw new LessAndEquelMinimumException();
        }
    }
}
