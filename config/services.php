<?php

return [
    'local_works' => [
        'intake_email' => env('LOCAL_WORKS_INTAKE_EMAIL'),
    ],

    'turnstile' => [
        'site_key' => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
    ],
];
