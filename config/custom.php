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
    | Utenti
    |--------------------------------------------------------------------------
    |
    */

    // Invio email di notifica inserimento nuovo utente
    'send_created_user_notification' => env('SEND_CREATED_USER_NOTIFICATION', true),

];
