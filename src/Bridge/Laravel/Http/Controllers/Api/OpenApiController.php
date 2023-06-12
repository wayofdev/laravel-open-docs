<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use OpenApi\Generator;

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

        $exclude = [];
        $pattern = '*.php';

        $openapi = Generator::scan(
            config('open-docs.documentation_source.paths', []),
            [
                'exclude' => $exclude,
                'pattern' => $pattern,
            ]
        );

        return response()->json(json_decode($openapi->toJson()));
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
