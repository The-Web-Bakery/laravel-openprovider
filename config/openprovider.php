<?php

return [
    'base_url' => env('OPENPROVIDER_CONNECTION', 'https://api.openprovider.eu/v1beta'),

    'connections' => [

        'default' => [
            'ip' => env('OPENPROVIDER_DEFAULT_IP', '0.0.0.0'),
            'username' => env('OPENPROVIDER_DEFAULT_USERNAME'),
            'password' => env('OPENPROVIDER_DEFAULT_PASSWORD'),
        ],

        'cte' => [
            'username' => env('OPENPROVIDER_CTE_USERNAME'),
            'password' => env('OPENPROVIDER_CTE_PASSWORD'),
            'cte' => true,
        ],
    ],
];