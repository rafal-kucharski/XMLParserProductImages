<?php

namespace App\Contracts;

use App\DTO\Product;

interface ProductImageGeneratorInterface
{
    public function generate(Product $product): string;

}
