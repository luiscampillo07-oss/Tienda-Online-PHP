<?php
session_start();

// Conexión a MySQL
$host = "127.0.0.1";
$user = "root";
$password = "123456";
$database = "tienda_db";

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Fallo la conexión: " . $mysqli->connect_error);
}

require_once "controllers/mainController.php";
?>