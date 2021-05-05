<?php

class rubro{
    private $descripcion;
    private $porcentajeGanancia;

    public function __construct($midescripcion, $miprocentaje)
    {
        $this->descripcion = $midescripcion;
        $this->porcentajeGanancia = $miprocentaje;
    }

    public function getdescripcion()
    {
        return $this->descripcion;
    }

    public function setdescripcion($midescripcion)
    {
        $this->descripcion    = $midescripcion;
    }

    public function getporcentajeGanancia()
    {
        return $this->porcentajeGanancia;
    }

    public function setporcentajeGanancia($miporcentaje)
    {
        $this->porcentajeGanancia = $miporcentaje;
    }

    public function __toString()
    {
        $cadena = " Descripcion del rubro: " . $this->getdescripcion() . "\n";
        $cadena .= " Porcentaje de Ganancia: " . $this->getporcentajeGanancia() . "\n";

        return $cadena;
    }
}
