<?php

namespace App\Jobs;

use App\DTO\Product;
use App\Services\ProductImageGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Product $product
    ) {}

    public function handle(ProductImageGenerator $imageGenerator): void
    {
        $outputPath = $imageGenerator->generate($this->product);
        info("Generated image for product {$this->product->id}: {$outputPath}");
    }
}
