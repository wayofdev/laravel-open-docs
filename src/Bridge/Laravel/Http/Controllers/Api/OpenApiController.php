<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

use WayOfDev\OpenDocs\Bridge\Laravel\Console\Commands\GenerateCommand;
use function file_exists;
use function file_get_contents;
use function json_decode;

final class OpenApiController extends Controller
{
    public function index(): JsonResponse
    {
        if (config('open-docs.documentation_source.on_fly') === false) {
            return response()->json($this->respondFromFile());
        }

        Artisan::call(GenerateCommand::class);

        return response()->json($this->respondFromFile());
    }

    private function respondFromFile(): object
    {
        $settings = config('open-docs.documentation_source');
        $filePath = $settings['save_to'] . '/' . $settings['filename'] . '.json';

        if (! file_exists($filePath)) {
            abort(404, 'Cannot find ' . $filePath);
        }

        return json_decode(
            file_get_contents($filePath)
        );
    }
}
