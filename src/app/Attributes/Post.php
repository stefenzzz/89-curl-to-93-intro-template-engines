<?php

declare(strict_types = 1);

namespace App\Attributes;

use App\Enums\HttpMethod;

#[\Attribute]
class Post extends Route
{
    public function __construct(public string $routePath)
    {
        parent::__construct($routePath,HttpMethod::Post);
    }

}