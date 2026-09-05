<?php

return [
    'enabled' => env('ANALYTICS_ENABLED', false),
    'provider' => env('ANALYTICS_PROVIDER', 'plausible'),
    'site_id' => env('ANALYTICS_SITE_ID'),
];
