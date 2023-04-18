<?php

namespace App\Services;

use App\Contracts\ProductImageGeneratorInterface;
use App\DTO\Product;
use Intervention\Image\Facades\Image;

class ProductImageGenerator implements ProductImageGeneratorInterface
{
    private string $fontPath;
    private int $titleHeight;
    private int $priceHeight;
    private int $lineSpacing;

    public function __construct()
    {
        $this->fontPath = resource_path('fonts/Roboto-Regular.ttf');
        $this->titleHeight = 150;
        $this->priceHeight = 150;
        $this->lineSpacing = 10;
    }

    public function generate(Product $product): string
    {
        $outputPath = storage_path("app/public/generated/{$product->id}.jpg");

        $image = Image::make($product->image_link);
        $image->fit(1000, 1000);

        $this->addTitleBackground($image);
        $this->addPriceBackground($image);

        $this->addTitleText($image, $product);
        $this->addPriceText($image, $product);

        $image->save($outputPath);

        return $outputPath;
    }

    private function addTitleBackground($image): void
    {
        $image->rectangle(0, 0, 1000, $this->titleHeight, function ($draw) {
            $draw->background('#999');
        });
    }

    private function addPriceBackground($image): void
    {
        $image->rectangle(0, 1000 - $this->priceHeight, 1000, 1000, function ($draw) {
            $draw->background('#999');
        });
    }

    private function addTitleText($image, Product $product): void
    {
        $titleMaxWidth = 1000 - 2 * 50;
        $titleLines = explode("\n", wordwrap($product->title, $titleMaxWidth / 18, "\n"));
        $titleY = $this->titleHeight / 2 - ((36 + $this->lineSpacing) * count($titleLines) / 2);
        foreach ($titleLines as $line) {
            $image->text($line, 50, $titleY, function ($font) {
                $font->file($this->fontPath);
                $font->size(36);
                $font->color('#000');
                $font->align('left');
                $font->valign('top');
            });
            $titleY += 36 + $this->lineSpacing;
        }
    }

    private function addPriceText($image, Product $product): void
    {
        $image->text(number_format($product->price, 2) . " " . $product->currency, 50, 1000 - $this->priceHeight / 2, function ($font) {
            $font->file($this->fontPath);
            $font->size(60);
            $font->color('#000');
            $font->align('left');
            $font->valign('middle');
        });
    }
}
