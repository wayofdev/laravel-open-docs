<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Bridge\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

final class RedocController extends Controller
{
    public function index(Request $request): View
    {
        $collection = $request->segment(2);
        $version = config('open-docs.frontend.redoc.version');
        $filePath = URL::route('open-docs.' . $collection . '.specification');

        return view('open-docs::redoc.index', [
            'documentationFile' => $filePath,
            'redocVersion' => $version,
        ]);
    }
}
