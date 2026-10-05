<?php

class ClienteRepository {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function login($usuario, $password) {
        // Sanitizar las entradas para seguridad
        $usuarioEscaped = $this->db->real_escape_string($usuario);
        $passwordEscaped = $this->db->real_escape_string($password);

        // Consulta directa sin prepared statements
        $sql = "SELECT * FROM Cliente WHERE (Nombre = '{$usuarioEscaped}' OR Email = '{$usuarioEscaped}') AND Password = '{$passwordEscaped}'";
        $resultado = $this->db->query($sql);

        if ($resultado && $cliente = $resultado->fetch_assoc()) {
            return $cliente;
        }

        return false;
    }

    public function obtenerPorId($id) {
        $idEscaped = (int)$id;
        $sql = "SELECT * FROM Cliente WHERE ID_Cliente = {$idEscaped}";
        $resultado = $this->db->query($sql);

        if ($resultado && $cliente = $resultado->fetch_assoc()) {
            return $cliente;
        }

        return null;
    }
}