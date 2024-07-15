<?php

return [
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'redirect_uri' => env('ZOOM_REDIRECT_URI'),
    'api_url' => 'https://api.zoom.us/v2/',
    'auth_url' => 'https://zoom.us/oauth/authorize',
    'token_url' => 'https://zoom.us/oauth/token',
];
