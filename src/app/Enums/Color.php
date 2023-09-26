<?php

declare(strict_types = 1);


namespace App\Enums;

enum Color: string
{
    case Green = 'green';
    case Gray = 'gray';
    case Red = 'red';
    case Blue = 'blue';

    public function getClass()
    {
        return 'color-'.$this->name;
    }
}