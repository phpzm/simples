<?php

return [
    'name' => 'Simples',
    'url' => env('CLIENT_DEFAULT_URL'),
    'namespace' => 'App\\',
    'src' => 'app/src/',
    'assets' => 'public/assets',
    'resources' => [
        'root' => 'app/resources',
    ],
    'storage' => [
        'root' => 'storage',
    ],
    'status' => [
        'success' => 200,
        'notFound' => 404,
        'notImplemented' => 501,
        'fail' => 500,
    ],
];
