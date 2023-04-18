<?php

namespace Tests\Unit;

use App\DTO\Product;
use App\Services\ProductImageGenerator;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageGeneratorTest extends TestCase
{
    /** @test */
    public function it_can_generate_image_with_product_data(): void
    {
        Storage::fake('public');

        $imageGenerator = app(ProductImageGenerator::class);
        $product = new Product(
            'TE-ZT-MF971-OP1-BL_4021691289',
            'Router mobilny kat. 6 ZTE MF-971R w abonamencie 99zł x 12 miesięcy + 12 rat x 10zł',
            24900.99,
            'PLN',
            'https://picsum.photos/seed/picsum/1200/1200.jpg',
        );

        $outputPath = $imageGenerator->generate($product);

        $this->assertFileExists($outputPath);
    }
}
