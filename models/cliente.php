<?php

class Cliente {
    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $telefono;
    private string $direccion;
    private string $password;

    public function __construct(int $id, string $nombre, string $apellidos, string $email, string $telefono, string $direccion, string $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->password = $password;
    }

    public function getId(): int {
        return $this->id; 
        }
    public function getNombre(): string { 
        return $this->nombre; 
        }
    public function getApellidos(): string {
        return $this->apellidos;
        }
    public function getEmail(): string { 
        return $this->email; 
        }
    public function getTelefono(): string { 
        return $this->telefono; 
        }
    public function getDireccion(): string { 
        return $this->direccion; }
    public function getPassword(): string {
        return $this->password;
     }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
}