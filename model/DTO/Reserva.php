<?php
//autor: Samuel Vera
class Reserva
{
    private $idReserva;
    private $fechaInicio;
    private $fechaFin;
    private $idCliente;
    private $idSalon;
    private $precioPact;
    private $estado;
    private $notas;

    public function __construct($idReserva, $fechaInicio, $fechaFin, $idCliente, $idSalon, $precioPact, $estado, $notas)
    {
        $this->idReserva = $idReserva;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->idCliente = $idCliente;
        $this->idSalon = $idSalon;
        $this->precioPact = $precioPact;
        $this->estado = $estado;
        $this->notas = $notas;
    }

    public function getIdReserva()
    {
        return $this->idReserva;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getIdSalon()
    {
        return $this->idSalon;
    }

    public function getPrecioPact()
    {
        return $this->precioPact;
    }

    public function getestado()
    {
        return $this->estado;
    }

    public function getNotas()
    {
        return $this->notas;
    }

}

?>