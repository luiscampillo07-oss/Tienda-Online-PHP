<?php
class Pedido {
    private array $lineas = [];
    private int $id ;
    private int $idCliente;
    private string $fecha;
    private string $estado;
    private int $total;
   
    public function __construct(int $id, int $idCliente, string $fecha, string $estado, int $total) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->total = $total;
        $this->linea = $lineas;
    }
    
    public function agregarLinea(LineaPedido $linea): void {
        $this->lineas[] = $linea;
        $this->total += $linea->getSubtotal();
    }

    public function getTotal(): int { 
        return $this->total; 
        }
    public function getLineas(): array { 
        return $this->lineas; 
        }
}
?>