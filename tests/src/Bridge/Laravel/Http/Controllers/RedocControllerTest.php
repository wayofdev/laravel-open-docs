<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Http\Controllers;

use Illuminate\Support\Facades\URL;
use WayOfDev\OpenDocs\Tests\TestCase;

final class RedocControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_view_response_from_redoc_route(): void
    {
        $this->copyStubFile('openapi.json');

        $response = $this->get(route('open-docs.redoc'));

        $response->assertStatus(200);
        $response->assertViewIs('open-docs::redoc.index');
        $response->assertViewHas('documentationFile', URL::route('open-docs.docs'));
        $response->assertViewHas('redocVersion', '2.0.0');
    }
}
