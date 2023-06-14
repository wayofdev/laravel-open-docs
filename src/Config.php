<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs;

use Illuminate\Support\Collection;
use WayOfDev\OpenDocs\Contracts\ConfigRepository;
use WayOfDev\OpenDocs\Exceptions\MissingRequiredAttributes;

use function array_diff;
use function array_keys;
use function implode;

final class Config implements ConfigRepository
{
    private const REQUIRED_FIELDS = [
        'on_fly',
        'frontend',
        'collections',
    ];

    private readonly bool $onFly;
    private readonly array $frontend;

    private readonly Collection $collections;

    public static function fromArray(array $config): self
    {
        $missingAttributes = array_diff(self::REQUIRED_FIELDS, array_keys($config));

        if ([] !== $missingAttributes) {
            throw MissingRequiredAttributes::fromArray(
                implode(',', $missingAttributes)
            );
        }

        return new self(
            $config['on_fly'],
            $config['frontend'],
            $config['collections'],
        );
    }

    public function __construct(
        bool $onFly,
        array $frontend,
        array $collections,
    ) {
        $this->onFly = $onFly;
        $this->frontend = $frontend;
        $this->collections = new Collection($collections);
    }

    public function onFly(): bool
    {
        return $this->onFly;
    }

    public function frontend(): array
    {
        return $this->frontend;
    }

    public function collections(): Collection
    {
        return $this->collections;
    }

    public function collectionPaths(string $collectionName): array
    {
        return $this->collections->get($collectionName)['paths'];
    }

    public function outputPath(string $collectionName, string $format = 'json'): string
    {
        return public_path($collectionName . '-openapi.' . $format);
    }
}
