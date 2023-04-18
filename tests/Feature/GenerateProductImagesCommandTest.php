<?php

namespace Tests\Feature;

use App\Jobs\ProcessProductJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GenerateProductImagesCommandTest extends TestCase
{
    /** @test */
    public function it_dispatches_jobs_to_generate_product_images(): void
    {
        Storage::fake('local');

        Queue::fake();

        $this->artisan('generate:product-images')
            ->expectsOutput('Queued product for image generation: TE-ZT-MF971-OP1-BL_4001297899')
            ->expectsOutput('Queued product for image generation: TE-ZT-MF971-OP1-BL_4021692569')
            ->expectsOutput('Queued product for image generation: TE-ZT-MF971-OP1-BL_4021691289')
            ->assertExitCode(0);

        Queue::assertPushed(ProcessProductJob::class, 3);
    }
}
