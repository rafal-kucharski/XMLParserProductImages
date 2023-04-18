<?php

namespace App\DTO;

class Product
{
    public function __construct(
        public string $id,
        public string $title,
        public float $price,
        public string $currency,
        public string $image_link
    ) {}
}
