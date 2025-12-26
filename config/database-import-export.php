<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Max Upload Size
    |--------------------------------------------------------------------------
    |
    | Taille maximale du fichier SQL uploadé en Ko (par défaut 10 Mo)
    |
    */
    'max_upload_size' => env('DATABASE_IMPORT_EXPORT_MAX_SIZE', 10240),

    /*
    |--------------------------------------------------------------------------
    | Temporary Export Directory
    |--------------------------------------------------------------------------
    |
    | Dossier temporaire pour les exports SQL
    |
    */
    'export_temp_dir' => storage_path('app/temp-exports'),

    /*
    |--------------------------------------------------------------------------
    | Import Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout en secondes pour l'import (par défaut 300s = 5 min)
    |
    */
    'import_timeout' => env('DATABASE_IMPORT_EXPORT_TIMEOUT', 300),
];
