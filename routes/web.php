<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api\OpenApiController;

Route::group(['as' => 'open-docs.'], static function (): void {
    $products = array_keys(
        config('open-docs.frontend')
    );
    foreach ($products as $product) {
        if (false === config('open-docs.frontend.' . $product . '.enabled', true)) {
            continue;
        }
        foreach (config('open-docs.collections', []) as $name => $config) {
            $url = Arr::get($config, $product . '.route.url');

            if (null === $url) {
                continue;
            }
            $controller = config('open-docs.frontend.' . $product . '.controller');
            Route::get($url, [$controller, 'index'])
                ->name($name . '.api-' . $product);
        }
    }
});

Route::group(['as' => 'open-docs.'], static function (): void {
    foreach (config('open-docs.collections', []) as $name => $config) {
        $url = Arr::get($config, 'docs.route.url');
        if (null === $url) {
            continue;
        }
        Route::get($url, [OpenApiController::class, 'index'])
            ->name($name . '.specification');
    }
});
