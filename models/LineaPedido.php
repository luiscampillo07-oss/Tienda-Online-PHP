<?php
class LineaPedido {
    private int $id;
    private int $idProducto;
    private int $cantidad;
    private float $precioUnitario;

    public function __construct(int $id, int $idProducto, int $cantidad, float $precioUnitario) {
    $this->id = $id;
    $this->idProducto = $idProducto;
    $this->cantidad = $cantidad;
    $this->precioUnitario = $precioUnitario;
    }
    public function getSubtotal(): float {
        return $this->cantidad * $this->precioUnitario;
    }
    public function getIdProducto(): int { 
        return $this->idProducto; 
        }
    public function getCantidad(): int { 
        return $this->cantidad; 
        }
    public function getPrecioUnitario(): float { 
        return $this->precioUnitario; 
        }
}