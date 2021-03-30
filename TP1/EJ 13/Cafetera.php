<?php
class Cafetera{

    //variables
private $capacidadMaxima;
private $cantidadActual;

 // private $contraseñaUtilizada;
public function __construct($capacidad, $cantidad)
{
    $this->capacidadMaxima = $capacidad;
    $this->cantidadActual = $cantidad;
}

// Observadoras
public function getCapacidadMaxima()
{
    return $this->capacidadMaxima;
}

public function setCapacidadMaxima($capacidad)
{
    $this->capacidadMaxima= $capacidad;
}

public function getCantidadActual()
{
    return $this->cantidadActual;
}

public function setCantidadActual($cantidad)
{
    $this->cantidadActual= $cantidad;
}
//metodos
public function llenarCafetera()
{
  $faltaCafe = $this->getCapacidadMaxima() - $this->getCantidadActual();
  $this->setCantidadActual($this->getCapacidadMaxima());

  return "se lleno la cafetera con: ".$faltaCafe." ml  \n";
}


public function servirTaza($cantidad)
{
    if ($this->getCantidadActual()===0){
        return "No posee cafe la cafetera, debe cargarse!";
    }else{
        if ($this->getCantidadActual()<$cantidad){

            return "No alcanzo!!, se cargo unicamente la cantidad de: ".$this->getCantidadActual().$this->setCantidadActual(0)." ml \n";
        }else{
            $sobracafe= $this->getCantidadActual() - $cantidad;
            $this->setCantidadActual($sobracafe);
    
            return "Se cargo la taza de cafe y sobra la cantidad de: ". $sobracafe." ml \n";
        }
    }
}


public function vaciarcafetera()
{
    $this->setCantidadActual(0);

    return "Se vacio la cafetera con exito!";
}

public function agregarCafe($cantidad)
{
    $this->setCantidadActual($this->getCantidadActual()+$cantidad);

    return "Se completo la cafetera con: ".$this->getCantidadActual()." ml \n";
}

public function __toString()
{
    return "la cafetera posee una capacidad de: ".$this->getCapacidadMaxima()." ml y posee un tatal de :". $this->getCantidadActual()." ml \n";
}

}
