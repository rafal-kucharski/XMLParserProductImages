<?php

namespace App\Services;

use App\Contracts\ProductParserInterface;
use App\DTO\Product;
use Closure;
use Exception;
use XMLReader;

class XmlProductParser implements ProductParserInterface
{
    /**
     * @throws Exception
     */
    public function parse(string $source, Closure $callback): void
    {
        $reader = new XMLReader();
        $reader->open($source);

        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->localName === 'record') {
                $xmlRecord = new \SimpleXMLElement($reader->readOuterXML());

                $product = new Product(
                    (string)$xmlRecord->id,
                    (string)$xmlRecord->title,
                    (float)$xmlRecord->price,
                    (string)$xmlRecord->currency,
                    (string)$xmlRecord->image_link
                );

                $callback($product);

                $reader->next();
            }
        }

        $reader->close();
    }
}
