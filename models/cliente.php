<?php

class Cliente {
    public function __construct(
        private ?int $id = null,
        private string $nombre = '',
        private string $apellidos = '',
        private string $email = '',
        private string $telefono = '',
        private string $direccion = '',
        private string $password = ''
    ) {}

    // Getters y Setters directos
    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getApellidos(): string { return $this->apellidos; }
    public function getEmail(): string { return $this->email; }
    public function getTelefono(): string { return $this->telefono; }
    public function getDireccion(): string { return $this->direccion; }
    public function getPassword(): string { return $this->password; }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setEmail(string $email): void {
        $this->email = ($email);
    }
}