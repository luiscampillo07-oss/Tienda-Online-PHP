<?php

class ClienteRepository {
    private $db;

    // Le pasamos la conexión $mysqli al crear la clase
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Registrar cliente con contraseña en texto plano
    public function registrar($nombre, $apellidos, $email, $telefono, $direccion, $password) {
        $sql = "INSERT INTO Cliente (Nombre, Apellidos, Email, Telefono, Direccion, Password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bind_param("ssssss", $nombre, $apellidos, $email, $telefono, $direccion, $password);
        return $consulta->execute();
    }

    // Comprobar el login
    public function login($email, $password) {
        $sql = "SELECT * FROM Cliente WHERE Email = ? AND Password = ?";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bind_param("ss", $email, $password);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc(); // Devuelve el cliente o null/false
    }

    // Buscar un cliente por ID
    public function obtenerPorId($id) {
        $consulta = $this->db->prepare("SELECT * FROM Cliente WHERE ID_Cliente = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }
}