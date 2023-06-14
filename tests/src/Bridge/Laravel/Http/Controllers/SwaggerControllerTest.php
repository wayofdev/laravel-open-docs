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
    public function it_gets_view_response_from_swagger_route_with_public_collection(): void
    {
        $response = $this->get(route('open-docs.public.api-swagger'));

        $response->assertStatus(200);
        $response->assertViewIs('open-docs::swagger.index');
        $response->assertViewHas('documentationFile', URL::route('open-docs.public.specification'));
        $response->assertViewHas('swaggerVersion', '4.19.0');
    }

    /**
     * @test
     */
    public function it_gets_view_response_from_swagger_route_with_admin_collection(): void
    {
        $response = $this->get(route('open-docs.admin.api-swagger'));

        $response->assertStatus(200);
        $response->assertViewIs('open-docs::swagger.index');
        $response->assertViewHas('documentationFile', URL::route('open-docs.admin.specification'));
        $response->assertViewHas('swaggerVersion', '4.19.0');
    }
}
