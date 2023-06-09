<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use WayOfDev\OpenDocs\Bridge\Laravel\Providers\OpenDocsServiceProvider;

use function copy;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        config()->set('open-docs.documentation_source.paths', [
            __DIR__ . '/../app/Controllers',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            OpenDocsServiceProvider::class,
        ];
    }

    protected function getStubDirectory(): string
    {
        return __DIR__ . '/../app/public';
    }

    protected function copyStubFile($fileName): void
    {
        $source = $this->getStubDirectory() . '/' . $fileName;
        $dest = public_path($fileName);

        copy($source, $dest);
    }
}
