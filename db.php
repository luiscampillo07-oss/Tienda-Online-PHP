<?php
function getDBConnection(): mysqli {
    $envFile = __DIR__ . '/.env';

    if (file_exists($envFile)) {
        $envVars = parse_ini_file($envFile);
        if (is_array($envVars)) {
            foreach ($envVars as $key => $value) {
                $_ENV[$key] = $value;
            }
        }
    }

    // Devuelve directamente la nueva instancia de mysqli
    return new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
}

// Asignar conexión global
$mysqli = getDBConnection();

if ($mysqli->connect_error) {
    die("Error de conexión a MariaDB: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
