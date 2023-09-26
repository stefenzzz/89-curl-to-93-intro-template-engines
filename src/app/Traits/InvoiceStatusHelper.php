<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Enums\Color;
use App\Enums\InvoiceStatus;

trait InvoiceStatusHelper
{
    public static function fromColor(Color $color){
        return match($color){
            Color::Green => InvoiceStatus::Paid,
            Color::Gray => InvoiceStatus::Void,
            Color::Red => InvoiceStatus::Failed,
            default=> InvoiceStatus::Pending
        };
    }
}