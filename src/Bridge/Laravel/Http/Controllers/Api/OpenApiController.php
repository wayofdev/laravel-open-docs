<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

use function file_exists;
use function file_get_contents;
use function json_decode;

final class OpenApiController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = config('open-docs.documentation_source');
        $filePath = $settings['save_to'] . '/' . $settings['filename'] . '.json';

        if (! file_exists($filePath)) {
            abort(404, 'Cannot find ' . $filePath);
        }

        $content = json_decode(
            file_get_contents($filePath)
        );

        return response()->json($content);
    }
}
