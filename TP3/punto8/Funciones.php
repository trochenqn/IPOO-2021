<?php 

class Funciones{

    //variables
private $nombre;
private $horarioInicio;
private $duracionObra;
private $precio;

 // private 
public function __construct($n, $hi, $do, $p)
{
    $this->nombre= $n;
    $this->horarioInicio = $hi;
    $this->duracionObra = $do;
    $this->precio = $p;
}

// Observadoras
public function getNombre()
{
    return $this->nombre;
}

public function setNombre($nombre)
{
    $this->nombre= $nombre;
}
public function getHorarioInicio()
{
    return $this->horarioInicio;
}

public function setHorarioInicio($hs_inicio)
{
    $this->horarioInicio= $hs_inicio;
}

public function getDuracionObra()
{
    return $this->duracionObra;
}

public function setDuracionObra($duracion)
{
    $this->duracionObra= $duracion;
}

public function getPrecio()
{
    return $this->precio;
}

public function setPrecio($prec)
{
    $this->precio= $prec;
}
//Metodos


public function __toString()
{
    
    $cadena = "Nombre de la funcion: ".$this->getNombre()."\n";
    $cadena .= " horario de funcion: ".$this->getHorarioInicio()."\n";
    $cadena .= " duracion de funcion: ".$this->getDuracionObra()."\n";
    $cadena .= " precio de funcion: ".$this->getPrecio()."\n";

    return $cadena;
}

}

?>