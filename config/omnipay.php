<?php

return [
    /** The default gateway name */
    'gateway'  => 'wmr',

    /** Default System Currency */
    'currency' => env('DEFAULT_CURRENCY', 'RUB'),

    /** The default settings, applied to all gateways */
    'defaults' => [
        'testMode' => false,
    ],

    /** Gateway specific parameters */
    'gateways' => [
        'wmr' => [
            'gateway' => 'WebMoney',
            'parameters' => [
                'currency'      => 'RUB',
                'merchantPurse' => 'R123456789000',
                'secretKey'     => 'secret',
            ]
        ],
        'wmz' => [
            'gateway' => 'WebMoney',
            'parameters' => [
                'currency'      => 'USD',
                'merchantPurse' => 'Z123456789000',
                'secretKey'     => 'secret',
            ]
        ],
    ]
];