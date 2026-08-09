<?php

/*
|--------------------------------------------------------------------------
| Admin Theme (Tabler) Settings
|--------------------------------------------------------------------------
|
| Valori di default per il pannello "Theme Settings" del tema Tabler
| (https://docs.tabler.io/ui). Ogni valore viene applicato come attributo
| data-bs-* sul tag <html> delle pagine dell'area admin e può essere
| sovrascritto a runtime dall'utente tramite il pannello impostazioni
| (salvato nel localStorage del browser, esattamente come nella demo
| ufficiale). Il valore qui definito è quindi solo il default iniziale.
|
| Le liste in 'options' sono quelle esposte da Tabler stesso: un valore
| .env non presente nella lista corrispondente viene ignorato e si
| ricade sul default.
|
*/

return [

    'options' => [
        'mode' => ['light', 'dark', 'auto'],
        'primary' => ['blue', 'azure', 'indigo', 'purple', 'pink', 'red', 'orange', 'yellow', 'lime', 'green', 'teal', 'cyan', 'inverted'],
        'base' => ['slate', 'gray', 'zinc', 'neutral', 'stone'],
        'radius' => ['0', '0.5', '1', '1.5', '2'],
        'font' => ['sans-serif', 'serif', 'monospace', 'comic'],
    ],

    'defaults' => [
        'mode' => 'light',
        'primary' => 'indigo',
        'base' => 'gray',
        'radius' => '1',
        'font' => 'sans-serif',
    ],

    'mode' => env('ADMIN_THEME_MODE', 'light'),
    'primary' => env('ADMIN_THEME_PRIMARY', 'indigo'),
    'base' => env('ADMIN_THEME_BASE', 'gray'),
    'radius' => (string) env('ADMIN_THEME_RADIUS', '1'),
    'font' => env('ADMIN_THEME_FONT', 'sans-serif'),

    /*
    |--------------------------------------------------------------------------
    | Bunny Fonts (https://fonts.bunny.net)
    |--------------------------------------------------------------------------
    |
    | Alternativa gratuita e GDPR-friendly a Google Fonts (nessun dato
    | dell'utente lascia l'UE). Il font scelto sostituisce lo stack
    | "sans-serif" di sistema usato di default da Tabler
    | (variabile CSS --tblr-font-sans-serif); le opzioni "serif",
    | "monospace" e "comic" del pannello Theme Settings restano invariate.
    |
    */

    'font_family' => env('ADMIN_FONT_FAMILY', 'Inter'),
    'font_weights' => env('ADMIN_FONT_WEIGHTS', '400,500,600,700'),

];
