<?php

    /*
    |--------------------------------------------------------------------------
    | Funzioni helper per le view
    |--------------------------------------------------------------------------
    |
    | Queste funzioni sono disponibili in tutte le view (e non solo) perchè il
    | file è caricato in tutte le pagine attraverso l'autoload:
    | composer.json -> autoload -> files
    |
    | Come standard le funzioni hanno la sintassi snack_case
    */

    /**
     * Ritorna Il titolo con la segnalazione dell'ENV attivo
     *
     * @param void
     * @return string
     */
    function app_title_env()
    {
        return config('app.env') != 'production' ? '[ '.ucwords(config('app.env')).' ] - ' : '';
    }

    /**
     * Ritorna se la sezione attiva è fra quelle passate
     *
     * @param array
     * @return bool
     */
    function is_section_active($list, $segment = 0)
    {
        foreach ($list as $l) {
            if (str_contains(app_section_name($segment), $l)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Ritorna il nome della sezione attiva.
     *
     * @return string
     */
    function app_section_name($segment = 0)
    {
        return request()->segments()[$segment];
    }
