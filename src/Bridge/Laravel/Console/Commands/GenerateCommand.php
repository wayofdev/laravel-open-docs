<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;

use function file_put_contents;

final class GenerateCommand extends Command
{
    protected $signature = 'open-docs:generate';

    protected $description = 'Regenerate open api docs.';

    public function handle(): void
    {
        $settings = config('open-docs.documentation_source');
        $paths = $settings['paths'];
        $saveTo = $settings['save_to'];
        $filename = $settings['filename'];
        $yamlOutputPath = $saveTo . '/' . $filename . '.yaml';
        $jsonOutputPath = $saveTo . '/' . $filename . '.json';

        $openapi = Generator::scan($paths);

        file_put_contents($yamlOutputPath, $openapi->toYaml());
        $this->info('OpenAPI YAML documentation generated at ' . $yamlOutputPath);

        file_put_contents($jsonOutputPath, $openapi->toJson());
        $this->info('OpenAPI JSON documentation generated at ' . $jsonOutputPath);
    }
}
