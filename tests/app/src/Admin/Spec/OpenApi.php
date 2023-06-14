<?php

declare(strict_types=1);

namespace WayOfDev\OpenDocs\App\Admin\Spec;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'WayOfDev Ecommerce API',
    title: 'WayOfDev API',
    contact: new OA\Contact(
        name: 'John Doe',
        email: 'support@wayof.dev'
    )
)]
class OpenApi
{
}
