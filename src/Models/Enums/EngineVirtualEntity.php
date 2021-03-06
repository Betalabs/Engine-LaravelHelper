<?php

namespace Betalabs\LaravelHelper\Models\Enums;

use MyCLabs\Enum\Enum;

class EngineVirtualEntity extends Enum
{
    const PRODUCT = 1;
    const SHIPPING_COMPANY = 2;
    const ITEMS_SLUG = 'items';
    const ITEM_SLUG = 'item';
}