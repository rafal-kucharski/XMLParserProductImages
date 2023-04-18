<?php

namespace App\Contracts;

use Closure;

interface ProductParserInterface
{
    public function parse(string $source, Closure $callback): void;
}
