<?php

use Illuminate\Support\Facades\Route;
use WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api\OpenApiController;
use WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\RedocController;
use WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\SwaggerController;

Route::get(
    config('open-docs.routing.docs.route'),
    OpenApiController::class . '@index'
)->name('open-docs.docs')
    ->middleware(config('open-docs.routing.docs.middleware', []));

if (true === config('open-docs.frontend.redoc.enabled', true)) {
    Route::get(
        config('open-docs.routing.ui.route'),
        RedocController::class . '@index'
    )->name('open-docs.redoc')
        ->middleware(config('open-docs.routing.ui.middleware', []));
}

if (true === config('open-docs.frontend.swagger.enabled', true)) {
    Route::get(
        config('open-docs.routing.console.route'),
        SwaggerController::class . '@index'
    )->name('open-docs.swagger')
        ->middleware(config('open-docs.routing.console.middleware', []));
}
