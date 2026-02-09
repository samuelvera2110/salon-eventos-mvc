<?php
//autor: Bryan López León
//DTO: Data Transfer Object

class Salon {
    private $id, $nombre, $ubicacion, $medida_metros, $capacidad, $precio_hora, $descripcion, $estado, $imagen;

    public function __construct() {}
    
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getUbicacion() { return $this->ubicacion; }
    public function getMedidaMetros() { return $this->medida_metros; }
    public function getCapacidad() { return $this->capacidad; }
    public function getPrecioHora() { return $this->precio_hora; }
    public function getDescripcion() { return $this->descripcion; }
    public function getEstado() { return $this->estado; }
    public function getImagen() { return $this->imagen; }

    public function __set($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }

    public function __get($propiedad) {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
    }
}