<?php
// Autor: Jeremy

class ServicioDTO {

    private $id_servicio;
    private $nombre_servicio;
    private $descripcion;
    private $precio;
    private $estado;

    public function getIdServicio() {
        return $this->id_servicio;
    }

    public function setIdServicio($id) {
        $this->id_servicio = $id;
    }

    public function getNombreServicio() {
        return $this->nombre_servicio;
    }

    public function setNombreServicio($nombre) {
        $this->nombre_servicio = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
