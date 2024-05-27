<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Annotations\OpenApi;
use OpenApi\Generator;
use WayOfDev\OpenDocs\Contracts\ConfigRepository;

use function file_put_contents;

final class GenerateCommand extends Command
{
    protected $signature = 'open-docs:generate {collection} {--format=json}';

    protected $description = 'Regenerate open api docs.';

    public function handle(ConfigRepository $config): int
    {
        $collection = $this->argument('collection');
        $collectionExists = $config->collections()->has($collection);

        if ($collectionExists === false) {
            $this->error('Collection "' . $collection . '" does not exist.');

            return self::FAILURE;
        }

        $paths = $config->collectionPaths($collection);

        /** @var OpenApi $openapi */
        $openapi = Generator::scan($paths);

        $format = $this->option('format');

        $path = $config->outputPath($collection, $format);
        file_put_contents($path, $openapi->toJson());
        $this->info('OpenAPI JSON documentation generated at ' . $path);

        return self::SUCCESS;
    }
}
