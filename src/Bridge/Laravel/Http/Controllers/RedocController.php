<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class RedocController extends Controller
{
    public function index(): View
    {
        $settings = config('open-docs.documentation_source');
        $filePath = url('api-docs/' . $settings['filename'] . '.json');
        $version = config('open-docs.frontend.redoc.version');

        return view('open-docs::redoc.index', [
            'documentationFile' => $filePath,
            'redocVersion' => $version,
        ]);
    }
}
