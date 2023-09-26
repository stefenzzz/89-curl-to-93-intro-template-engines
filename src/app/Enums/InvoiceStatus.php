<?php


declare(strict_types = 1);

namespace App\Enums;
use App\Enums\Color;
use App\Traits\InvoiceStatusHelper;

enum InvoiceStatus: int
{
    use InvoiceStatusHelper;

    
    case Pending = 0;
    case Paid = 1;
    case Void = 2;
    case Failed = 3;
    

    public function name():string
    {
        return $this->name;
    }

    public function toString():string
    {
        return match($this){
            self::Paid => 'paid',
            self::Void => 'void',
            self::Failed => 'failed',
            default => 'pending'
        };
    }

    public function color(){
        return match($this){
            self::Paid => Color::Green,
            self::Void => Color::Gray,
            self::Failed => Color::Red,
            default => Color::Blue,
        };
    }


}