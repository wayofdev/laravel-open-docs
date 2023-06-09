<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\Tests\Bridge\Laravel\Http\Controllers\Api;

use WayOfDev\OpenDocs\Tests\TestCase;

use function file_get_contents;
use function json_decode;

final class OpenApiControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_json_output_from_docs_route(): void
    {
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
}
