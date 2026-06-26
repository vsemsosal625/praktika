<?php

return [
    // Согласно ТЗ (п.4.4) используется Argon2id
    'driver' => env('HASH_DRIVER', 'argon2id'),
    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 12),
        'verify' => env('HASH_VERIFY', true),
        'limit' => null,
    ],
    'argon' => [
        'memory' => env('ARGON_MEMORY', 65536),
        'threads' => env('ARGON_THREADS', 1),
        'time' => env('ARGON_TIME', 4),
        'verify' => env('HASH_VERIFY', true),
    ],
    'rehash_on_login' => true,
];
