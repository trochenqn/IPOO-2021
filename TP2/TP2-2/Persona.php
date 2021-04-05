<?php

class Persona{
    //variables
private $nombre;
private $apellido;
private $tipoDNI;
private $numeroDocumento;

public function __construct($n, $a, $td, $nd)
{
    $this->nombre= $n;
    $this->apellido = $a;
    $this->tipoDNI = $td;
    $this->numeroDocumento = $nd;
}
//get y set
public function getApellido()
{
    return $this->apellido;
}
public function setApellido($apellido)
{
    $this->apellido = $apellido;
}

public function setNombre($nombre)
{
    $this->nombre= $nombre;
}
public function getNombre()
{
    return $this->nombre;
}
public function setTipoDni($TipoDni)
{
    $this->tipoDNI= $TipoDni;
}
public function getTipoDni()
{
    return $this->tipoDNI;
}
public function setNumeroDni($NumeroDni)
{
    $this->numeroDocumento = $NumeroDni;
}
public function getNumeroDocumento()
{
    return $this->numeroDocumento;
}

//metodos


public function __toString()
{
 
    $retorna = "\n Nombre y Apellido. ".$this->getNombre().",  ". $this->getApellido()." - \nTipo  ". $this->getTipoDni().": ". $this->getNumeroDocumento()." \n";

    return $retorna;

}


}



?>