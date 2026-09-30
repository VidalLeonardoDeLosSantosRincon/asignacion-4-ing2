<?php

function loadEnv(string ...$paths): void
{
    foreach ($paths as $path) {
        if (!file_exists($path)) {
            continue;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Omitir líneas vacías o comentarios
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Validar que la línea tenga el separador '='
            if (str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);

                $key = trim($key);
                // Remueve espacios e inicios/finales de comillas (" o ')
                $value = trim($value, " \t\n\r\0\x0B\"'");

                // Al reasignar sin condicionar, los archivos posteriores
                // sobrescriben los valores definidos previamente
                $_ENV[$key] = $value;
                putenv("{$key}={$value}");
            }
        }
    }
}

// Carga en orden: .env -> .env.local
// Si una variable está en ambos, el valor de .env.local prevalece
loadEnv(
    __DIR__ . '/../.env',
    __DIR__ . '/../.env.local'
);
