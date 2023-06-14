<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests;

use Illuminate\Config\Repository;
use Orchestra\Testbench\TestCase as Orchestra;
use WayOfDev\OpenDocs\Bridge\Laravel\Providers\OpenDocsServiceProvider;

use function copy;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function defineEnvironment($app): void
    {
        tap($app->make('config'), function (Repository $config): void {
            config()->set('open-docs.collections.public.paths', [
                __DIR__ . '/../app/src/Public',
            ]);

            config()->set('open-docs.collections.admin.paths', [
                __DIR__ . '/../app/src/Admin',
            ]);
        });
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
