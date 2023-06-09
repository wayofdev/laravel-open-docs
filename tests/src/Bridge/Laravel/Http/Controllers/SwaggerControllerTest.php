<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Http\Controllers;

use Illuminate\Support\Facades\URL;
use WayOfDev\OpenDocs\Tests\TestCase;

final class SwaggerControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_view_response_from_swagger_route(): void
    {
        $this->copyStubFile('openapi.json');

        $response = $this->get(route('open-docs.swagger'));

        $response->assertStatus(200);
        $response->assertViewIs('open-docs::swagger.index');
        $response->assertViewHas('documentationFile', URL::to('api-docs/openapi.json'));
        $response->assertViewHas('swaggerVersion', config('open-docs.frontend.swagger.version'));
    }
}
