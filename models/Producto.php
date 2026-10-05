<?php
class Producto {
    public function __construct(
        private ?int $id = null,
        private string $nombre = '',
        private string $descripcion = '',
        private float $precio = 0.0,
        private int $stock = 0,
        private int $idCategoria = 0
    ) {}

    // Getters y Setters
    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getPrecio(): float { return $this->precio; }
    public function getStock(): int { return $this->stock; }
    
    public function reducirStock(int $cantidad): void {
        if ($cantidad > $this->stock) {
            throw new Exception("Stock insuficiente para el producto {$this->nombre}");
        }
        $this->stock -= $cantidad;
    }
}