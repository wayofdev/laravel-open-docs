<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use JsonException;
use WayOfDev\OpenDocs\Bridge\Laravel\Console\Commands\GenerateCommand;
use WayOfDev\OpenDocs\Contracts\ConfigRepository;

use function file_get_contents;
use function is_file;
use function json_decode;

final class OpenApiController extends Controller
{
    public function __construct(private readonly ConfigRepository $config)
    {
    }

    /**
     * @throws JsonException
     */
    public function index(Request $request): JsonResponse
    {
        $collection = $request->segment(2);

        if (config('open-docs.on_fly') === true) {
            Artisan::call(GenerateCommand::class, [
                'collection' => $collection,
            ]);
        }

        return response()->json($this->respondFromFile($collection));
    }

    /**
     * @throws JsonException
     */
    private function respondFromFile(string $collection): object
    {
        $path = $this->config->outputPath($collection);

        if (! is_file($path)) {
            abort(404, 'Cannot find ' . $path);
        }

        return json_decode(
            file_get_contents($path),
            false,
            512,
            JSON_THROW_ON_ERROR
        );
    }
}
