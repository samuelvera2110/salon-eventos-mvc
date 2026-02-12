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
     public function __construct($idReserva = null, $fechaInicio = null, $fechaFin = null, $idCliente = null, $idSalon = null, $precioPact = null, $estado = null, $notas = null)
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

    public function setId($idReserva)
    {
        $this->idReserva = $idReserva;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    public function setIdSalon($idSalon)
    {
        $this->idSalon = $idSalon;
    }

    public function setPrecioPact($precioPact)
    {
        $this->precioPact = $precioPact;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}

?>