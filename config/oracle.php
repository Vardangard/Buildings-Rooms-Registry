<?php

return [
    'luadm' => [
        'driver'         => 'oracle',
        'tns'            => env('LUADM_TNS', ''),
        'host'           => env('LUADM_HOST', ''),
        'port'           => env('LUADM_PORT', '1521'),
        'database'       => env('LUADM_DATABASE', ''),
        'username'       => env('LUADM_USERNAME', ''),
        'password'       => env('LUADM_PASSWORD', ''),
        'charset'        => env('LUADM_CHARSET', 'AL32UTF8'),
        'prefix'         => env('LUADM_PREFIX', ''),
        'prefix_schema'  => env('LUADM_SCHEMA_PREFIX', ''),
        'edition'        => env('LUADM_EDITION', 'ora$base'),
        'server_version' => env('LUADM_SERVER_VERSION', '11g'),
    ],
];
