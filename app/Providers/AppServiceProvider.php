<?php

namespace App\Providers;

use App\Contracts\ProductParserInterface;
use App\Services\XmlProductParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductParserInterface::class, XmlProductParser::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
