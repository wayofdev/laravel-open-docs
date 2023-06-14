<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\App\Admin\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JsonException;
use OpenApi\Attributes as OA;

use function json_encode;

class StubController extends Controller
{
    /**
     * Get list of products.
     *
     * @throws JsonException
     */
    #[OA\Get(path: '/api/admin/products')]
    #[OA\Response(response: 200, description: 'OK')]
    #[OA\Response(response: 422, description: 'Not authorized')]
    public function index(): Response
    {
        return response(json_encode(['test' => 'test'], JSON_THROW_ON_ERROR));
    }
}
