<<<<<<< Updated upstream
<?php

require_once("db.php");
require_once("controllers/mainController.php");
?>
=======
<?php
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/repositories/ProductoRepository.php';

$productoRepo = new ProductoRepository($mysqli);
$productos = $productoRepo->obtenerTodos();

$title = "TiendaPHP";

require_once __DIR__ . '/views/mainView.phtml';
>>>>>>> Stashed changes
