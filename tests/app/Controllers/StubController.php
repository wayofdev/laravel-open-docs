<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\App\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;

use function json_encode;

class StubController extends Controller
{
    /**
     * Get list of products.
     */
    #[OA\Get(path: '/api/public/products')]
    #[OA\Response(response: 200, description: 'OK')]
    #[OA\Response(response: 422, description: 'Not authorized')]
    public function index(): Response
    {
        return response(json_encode(['test' => 'test']));
    }
}
