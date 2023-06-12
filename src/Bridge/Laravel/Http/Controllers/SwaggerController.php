<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

final class SwaggerController extends Controller
{
    public function index(): View
    {
        $filePath = URL::route('open-docs.docs');
        $version = config('open-docs.frontend.swagger.version');

        return view('open-docs::swagger.index', [
            'documentationFile' => $filePath,
            'swaggerVersion' => $version,
        ]);
    }
}
