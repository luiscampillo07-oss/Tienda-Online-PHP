<?php

class ClienteRepository {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function login($email, $password) {
        // En MariaDB/MySQL comprobamos el cliente
        $sql = "SELECT * FROM Cliente WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($cliente = $resultado->fetch_assoc()) {
            // Si la contraseña no está encriptada en la BD o si usas password_verify:
            if (isset($cliente['Password']) && $cliente['Password'] === $password) {
                return $cliente;
            }
            return $cliente; // Si la tabla Cliente no tiene columna Password y solo valida por email
        }
        return false;
    }
}