<?php

return [
    'integrations' => [
        'api_base_url' => env('TMDB_API_BASE_URL', 'https://api.themoviedb.org/3/'),
        'api_key' => env('TMDB_API_KEY'),
        'api_token' => env('TMDB_API_BEARER'),
    ]
];
