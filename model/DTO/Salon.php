<?php
//autor: Bryan López León
//DTO: Data Transfer Object

class Salon {
    private $id, $nombre, $ubicacion, $medida_metros, $capacidad, $precio_hora, $descripcion, $estado;

    public function __construct() {
    }

    //getters funcionales
    public function getId() { 
        return $this->id; 
        }
    public function getNombre() { 
        return $this->nombre; 
        }
    public function getUbicacion() { 
        return $this->ubicacion;
        }
    public function getMedidaMetros() { 
        return $this->medida_metros; 
        }
    public function getCapacidad() { 
        return $this->capacidad; 
        }
    public function getPrecioHora() {
        return $this->precio_hora; 
        }
    public function getDescripcion() { 
        return $this->descripcion; 
        }
    public function getEstado() { 
        return $this->estado; 
        }

    //setters funcionales del registro
    public function __set($name, $value) { $this->$name = $value; }
}