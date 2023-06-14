<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use WayOfDev\OpenDocs\Tests\TestCase;

final class GenerateCommandTest extends TestCase
{
    /**
     * @test
     */
    public function it_generates_openapi_files_for_public_collection(): void
    {
        Artisan::call('open-docs:generate public');
        $output = Artisan::output();

        $this::assertStringContainsString('OpenAPI JSON documentation generated at', $output);
        $this::assertFileExists(public_path('public-openapi.json'));
    }

    /**
     * @test
     */
    public function it_generates_openapi_files_for_admin_collection(): void
    {
        Artisan::call('open-docs:generate admin');
        $output = Artisan::output();

        $this::assertStringContainsString('OpenAPI JSON documentation generated at', $output);
        $this::assertFileExists(public_path('admin-openapi.json'));
    }
}
