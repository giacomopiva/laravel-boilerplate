<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configurazioni custom
    |--------------------------------------------------------------------------
    |
    | Usage: config('custom.custom_config')
    */

    //'custom_config' => env('CUSTOM_CONFIG', 'Default value'),

    /*
    |--------------------------------------------------------------------------
    | Application
    |--------------------------------------------------------------------------
    |
    */

    'version' => env('APP_VERSION', '1.0'),

    'logo_name' => env('APP_LOGO_NAME', 'logo@2x.png'),

    /*
    |--------------------------------------------------------------------------
    | Utenti
    |--------------------------------------------------------------------------
    |
    */

    // Invio email di notifica inserimento nuovo utente
    'send_created_user_notification' => env('SEND_CREATED_USER_NOTIFICATION', true),

];
