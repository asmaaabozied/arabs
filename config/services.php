<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    //    todo comment redirect to localhost url and replace with redirect to server line
    'google' => [
        'client_id' => '195978537766-ekmm5putvges54pot5audmpduv5vq022.apps.googleusercontent.com',
        'client_secret' => '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',
//        'redirect' => 'https://arabworkers.com/app/authorized/google/callback',
        'redirect' => 'http://127.0.0.1:8000/authorized/google/callback',
    ],


];
