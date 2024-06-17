<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-dp6EUF0KuTabUdBvDBLUNK_j'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-jddSN0rh0pM5CeFH'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
