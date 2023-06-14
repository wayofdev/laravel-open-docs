<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Providers;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use WayOfDev\OpenDocs\Bridge\Laravel\Console\Commands\GenerateCommand;
use WayOfDev\OpenDocs\Config;
use WayOfDev\OpenDocs\Contracts\ConfigRepository;

final class OpenDocsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../../../resources/views', 'open-docs');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../../../config/open-docs.php' => config_path('open-docs.php'),
            ], 'config');
        }

        $this->registerConsoleCommands();
        $this->loadRoutesFrom(__DIR__ . '/../../../../routes/web.php');
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton(ConfigRepository::class, function (Application $app): Config {
            /** @var Repository $config */
            $config = $app['config'];

            return Config::fromArray([
                'on_fly' => $config->get('open-docs.on_fly'),
                'frontend' => $config->get('open-docs.frontend'),
                'collections' => $config->get('open-docs.collections'),
            ]);
        });

        $this->mergeConfigFrom(__DIR__ . '/../../../../config/open-docs.php', 'open-docs');
    }

    private function registerConsoleCommands(): void
    {
        $this->commands([
            GenerateCommand::class,
        ]);
    }
}
