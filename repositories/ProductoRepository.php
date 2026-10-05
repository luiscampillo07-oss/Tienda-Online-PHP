<?php

class ProductoRepository {
    private $db;

    // Le pasamos la conexión $mysqli al crear la clase
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Traer todos los productos
    public function obtenerTodos() {
        $resultado = $this->db->query("SELECT * FROM Producto");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Buscar un producto por ID
    public function obtenerPorId($id) {
        $consulta = $this->db->prepare("SELECT * FROM Producto WHERE ID_Producto = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    // Actualizar el stock
    public function actualizarStock($idProducto, $nuevoStock) {
        $consulta = $this->db->prepare("UPDATE Producto SET Stock = ? WHERE ID_Producto = ?");
        $consulta->bind_param("ii", $nuevoStock, $idProducto);
        return $consulta->execute();
    }
}