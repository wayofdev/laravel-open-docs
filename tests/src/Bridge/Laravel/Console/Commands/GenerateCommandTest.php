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
    public function it_generates_openapi_files(): void
    {
        Artisan::call('open-docs:generate');
        $output = Artisan::output();

        $this::assertStringContainsString('OpenAPI YAML documentation generated at', $output);
        $this::assertStringContainsString('OpenAPI JSON documentation generated at', $output);
    }
}
