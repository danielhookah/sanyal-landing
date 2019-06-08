<?php

$dbConnector = [
    'meta' => [
        'entity_path' => [
            __DIR__ . '/../app/Entities'
        ],
        'auto_generate_proxies' => true,
        'proxy_dir' => __DIR__ . '/../app/Entities/Proxies',
        'proxy_namespace' => 'Proxies',
        'cache' => null,
    ],
    'connection' => [
        'driver' => 'pdo_mysql',
        'host' => getenv('DB_HOST'),
        'dbname' => getenv('DB_NAME'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASS'),
        'charset' => 'UTF8',
        'options' => [
            "1001" => true
        ]
    ]
];