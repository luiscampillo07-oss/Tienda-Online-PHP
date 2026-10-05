<?php
class Producto {
    private int $id;
    private string $nombre;
    private string $descripcion;
    private int $precio;
    private int $stock;
    private int $idCategoria;

    public function __construct(int $id, string $nombre, string $descripcion, int $precio, int $stock, int $idCategoria) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->idCategoria = $idCategoria;
    }
    public function getId(): int { 
        return $this->id; 
        }
    public function getNombre(): string { 
        return $this->nombre; 
        }
    public function getPrecio(): int { 
        return $this->precio; 
        }
    public function getStock(): int { 
        return $this->stock; 
        }
    public function getIdCategoria(): int { 
        return $this->idCategoria; 
        }

    public function reducirStock(int $cantidad): void {
        $this->stock -= $cantidad;
    }
}
?>