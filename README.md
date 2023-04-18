# XML Parser Product Images

Laravel application to generate product images with title and price, based on an XML product feed.

## Installation

1. Clone the repository:

```bash
git clone git@github.com:rafal-kucharski/XMLParserProductImages.git laravel-product-image-generator
```

2. Change to the project directory:

```bash
cd laravel-product-image-generator
```

3. Build and run the Docker container:

```bash
docker-compose up --build -d
```

4. Install the Laravel application dependencies:

```bash
docker-compose exec app composer install
```

5. Copy the .env.example file to .env:

```bash
cp .env.example .env
```

6. Generate the application key:

```bash
docker-compose exec app php artisan key:generate
```

## Commands

To generate product images from an XML product feed:

```bash
docker-compose exec app php artisan generate:product-images [source]
```

Replace [source] with the path or URL to the XML product feed. If no source is provided, the default sample_feed.xml in the database/sources directory will be used.

Generated images will be saved in the storage/app/public/generated directory.

## Testing

```bash
docker-compose exec app php artisan test
```

```bash
docker-compose exec app ./vendor/bin/phpstan analyse
```
