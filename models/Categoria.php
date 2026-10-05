<?php
class Categoria {
    public function __construct(
        private ?int $id = null,
        private string $nombre = '',
        private string $descripcion = '',
        private ?int $idCategoriaPadre = null
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getIdCategoriaPadre(): ?int { return $this->idCategoriaPadre; }
}