<?php

function loadEnv(string $path): void
{
    $lines = file($path, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line)
    {
        if (empty($line)) continue;

        [$key, $value] = explode('=', $line, 2);

        $_ENV[$key] = $value;
    }
}

?>