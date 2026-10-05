<?php
class Pedido {
    private array $lineas = [];

    public function __construct(
        private ?int $id = null,
        private int $idCliente = 0,
        private string $fecha = '',
        private string $estado = 'Pendiente',
        private float $total = 0.0
    ) {}

    public function agregarLinea(LineaPedido $linea): void {
        $this->lineas[] = $linea;
        $this->total += $linea->getSubtotal();
    }

    public function getTotal(): float { return $this->total; }
    public function getLineas(): array { return $this->lineas; }
}
?>