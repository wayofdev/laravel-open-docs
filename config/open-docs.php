<?php

declare(strict_types=1);

return [
    'frontend' => [
        /*
         * Should swagger be enabled by default
         */
        'swagger' => [
            'enabled' => env('OPEN_DOCS_SWAGGER_ENABLED', true),

            'version' => '4.19.0',
        ],

        /*
         * Should redoc be enabled by default
         */
        'redoc' => [
            'enabled' => env('OPEN_DOCS_REDOC_ENABLED', true),

            'version' => '2.0.0',
        ],
    ],

    'documentation_source' => [
        /*
         * Should documentation be generated on fly
         */
        'on_fly' => true,

        /*
         * Do conversion from yml to json.
         */
        'convert' => true,

        /*
         * Documentation file type. Supported types are compatible with OpenApi 3 specification:
         * yml, json
         */
        'extension' => 'yml',

        /*
         * Directory paths, which will be scanned for controllers.
         */
        'paths' => [
            app_path('Http/Controllers'),
        ],

        /*
         * Filename, without extension.
         */
        'filename' => 'openapi',

        /*
         * Where to save converted documentation
         */
        'save_to' => base_path('public/'),
    ],

    'views' => [
        /*
         * Absolute path to views directory
         */
        'path' => base_path('resources/views/vendor/open-docs'),
    ],

    'routing' => [
        /*
         * JSON documentation output
         */
        'docs' => [
            /*
             * Route for accessing converted json file
             */
            'route' => '/docs',

            'middleware' => [
            ],
        ],

        /*
         * UI Interface
         */
        'ui' => [
            /*
             * Route for accessing Redoc UI API interface
             */
            'route' => '/api/redoc',

            'middleware' => [
            ],
        ],

        'console' => [
            /*
             * Route for accessing Swagger UI API interface
             */
            'route' => '/api/swagger',

            'middleware' => [
            ],
        ],
    ],
];
