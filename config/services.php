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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '695294047734-ho44dgerll8b93ng8lh358npi569i4rm.apps.googleusercontent.com',
        'client_secret' => '4pCWq-1ZGsCr7rskMLLqDkDN',
        'redirect' => 'http://store.bukitbiak.com/auth/google/callback/',
     
    ],

    'midtrans' => [
        'serverKey'     => env('MIDTRANS_SERVERKEY'),
        'clientKey'     => env('MIDTRANS_CLIENTKEY'),
        'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
        'isSanitized'   => env('MIDTRANS_IS_SANITIZED', true),
        'is3ds'         => env('MIDTRANS_IS_3DS', true),                
    ],
   
    'rajaongkir' => [
        'api_key'       => env('RAJAONGKIR_API_KEY'),
        'account_type'  => 'starter', //starter,basic,pro          
    ],

   

];
