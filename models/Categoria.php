<?php
class Categoria {
    private int $id;
    private string $nombre;
    private string $descripcion;
    private int $idCategoriaPadre;
    
    public function __construct(int $id, string $nombre, string $descripcion, int $idCategoriaPadre) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->idCategoriaPadre = $idCategoriaPadre;
    }

    public function getId(): int {
        return $this->id; 
        }
    public function getNombre(): string {
        return $this->nombre; 
        }
    public function getDescripcion(): string {
        return $this->descripcion;
        }
    public function getIdCategoriaPadre(): int {
        return $this->idCategoriaPadre;
        }
}
?>