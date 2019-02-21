<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | You can set up as many projects as you want, simply add an entry
    | to the 'connections' section of this file. The default connection
    | is the fallback connection when you don't want to specify one each
    | time you call the facade.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Sambatech Credentials
    |--------------------------------------------------------------------------
    |
    | Here you may specify the credentials of your Sambatech account.
    | First of all you must go to your account and create a "App" with
    | the needed scopes.
    |
    */

    'connections' => [
        'main' => [
            'pid' => env('SAMBATECH_PROJECT_ID'),
            'access_token' => env('SAMBATECH_ACCESS_TOKEN')
        ]
    ]
];
