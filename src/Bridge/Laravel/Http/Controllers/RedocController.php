<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

final class RedocController extends Controller
{
    public function index(): View
    {
        $filePath = URL::route('open-docs.docs');
        $version = config('open-docs.frontend.redoc.version');

        return view('open-docs::redoc.index', [
            'documentationFile' => $filePath,
            'redocVersion' => $version,
        ]);
    }
}
