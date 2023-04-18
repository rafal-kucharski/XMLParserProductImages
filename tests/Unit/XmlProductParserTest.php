<?php

namespace Tests\Unit;

use App\Contracts\ProductParserInterface;
use App\DTO\Product;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class XmlProductParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_products_from_xml_file(): void
    {
        Storage::fake('local');

        $parser = app(ProductParserInterface::class);
        $products = [];

        $xml = base_path('database/sources/sample_feed.xml');

        $parser->parse($xml, function ($product) use (&$products) {
            $this->assertInstanceOf(Product::class, $product);
            $products[] = $product;
        });

        $this->assertCount(3, $products);
        $this->assertEquals('TE-ZT-MF971-OP1-BL_4001297899', $products[0]->id);
        $this->assertEquals('1.0', $products[0]->price);
        $this->assertEquals('Router mobilny kat. 6 ZTE MF-971R', $products[0]->title);
    }
}
