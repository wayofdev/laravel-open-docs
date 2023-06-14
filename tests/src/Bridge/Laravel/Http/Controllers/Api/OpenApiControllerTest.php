<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Http\Controllers\Api;

use JsonException;
use WayOfDev\OpenDocs\Tests\TestCase;

use function file_get_contents;
use function json_decode;

final class OpenApiControllerTest extends TestCase
{
    /**
     * @test
     *
     * @throws JsonException
     */
    public function it_gets_response_for_public_collection(): void
    {
        $response = $this->get(route('open-docs.public.specification'));

        $response->assertStatus(200);
        $response->assertJson(
            json_decode(
                file_get_contents(public_path('public-openapi.json')),
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }

    /**
     * @test
     *
     * @throws JsonException
     */
    public function it_gets_response_for_admin_collection(): void
    {
        $response = $this->get(route('open-docs.admin.specification'));

        $response->assertStatus(200);
        $response->assertJson(
            json_decode(
                file_get_contents(public_path('admin-openapi.json')),
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }
}
