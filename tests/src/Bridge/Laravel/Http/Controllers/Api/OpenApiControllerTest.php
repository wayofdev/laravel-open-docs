<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Http\Controllers\Api;

use WayOfDev\OpenDocs\Tests\TestCase;

use function file_get_contents;
use function json_decode;

final class OpenApiControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_gets_json_output_from_docs_route_using_file(): void
    {
        config()->set('open-docs.documentation_source.on_fly', false);

        $this->copyStubFile('openapi.json');

        $response = $this->get(route('open-docs.docs'));
        $response->assertStatus(200);
        $response->assertJson(
            json_decode(
                file_get_contents($this->getStubDirectory() . '/openapi.json'),
                true
            )
        );
    }

    public function it_gets_json_output_from_docs_route_on_fly(): void
    {
        config()->set('open-docs.documentation_source.on_fly', true);

        $this->copyStubFile('openapi.json');

        $response = $this->get(route('open-docs.docs'));
        $response->assertStatus(200);
    }
}
