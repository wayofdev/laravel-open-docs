<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Contracts;

use Illuminate\Support\Collection;

interface ConfigRepository
{
    public function onFly(): bool;

    public function frontend(): array;

    public function collections(): Collection;

    public function collectionPaths(string $collectionName): array;

    public function outputPath(string $collectionName, string $format = 'json'): string;
}
