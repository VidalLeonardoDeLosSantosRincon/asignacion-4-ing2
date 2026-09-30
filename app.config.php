<?php 
    require_once __DIR__ . '/config/env.php';

    /*
    |--------------------------------------------------------------------------
    | Application Status / Kill Switch
    |--------------------------------------------------------------------------
    | - false: La aplicación funciona normalmente.
    | - true:  La aplicación se detiene e informa el estado.
    */

    // Comparar explícitamente como string
    $killSwitch = ($_ENV['KILL_SWITCH'] ?? 'false') === 'true';
    if ($killSwitch) {
        // Retornar encabezado 503 para que los navegadores y bots sepan que es temporal
        http_response_code(503);
        header('Retry-After: 300'); // Reintentar en 5 minutos
        
        die('El sistema se encuentra temporalmente fuera de servicio por mantenimiento.');
    }
