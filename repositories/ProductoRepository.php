<?php

class ProductoRepository {
    private $mysqli;

    public function __construct($db) {
        $this->mysqli = $db;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM Producto";
        $result = $this->mysqli->query($sql);
        
        $productos = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }
}