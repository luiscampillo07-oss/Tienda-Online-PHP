<?php
class LineaPedido {
    public function __construct(
        private ?int $id = null,
        private int $idProducto = 0,
        private int $cantidad = 0,
        private float $precioUnitario = 0.0
    ) {}

    public function getSubtotal(): float {
        return $this->cantidad * $this->precioUnitario;
    }
    public function getIdProducto(): int { return $this->idProducto; }
    public function getCantidad(): int { return $this->cantidad; }
    public function getPrecioUnitario(): float { return $this->precioUnitario; }
}