<?php

namespace App\Console\Commands;

use App\Contracts\ProductParserInterface;
use App\Jobs\ProcessProductJob;
use Illuminate\Console\Command;

class GenerateProductImagesCommand extends Command
{
    protected $signature = 'generate:product-images {--url=}';
    protected $description = 'Generate product images with title and price';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ProductParserInterface $parser): int
    {
        $url = $this->option('url') ?: base_path('database/sources/sample_feed.xml');

        $parser->parse($url, function ($product) {
            ProcessProductJob::dispatch($product);
            $this->info("Queued product for image generation: {$product->id}");
        });

        return 0;
    }
}
