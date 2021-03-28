<?php

class Fecha{
    //variables
private $dias;
private $mes;
private $anos;

public function __construct($d, $m, $a)
{
    $this->dias = $d;
    $this->mes = $m;
    $this->anos = $a;
}

//get y set
//dias
public function getDias()
{
    return $this->dias;
}
public function seDias($dias)
{
    $this->dias=$dias;
}
//mes
public function getMes()
{
    return $this->mes;
}
public function setMes($mes)
{
    $this->mes=$mes;
}
//anos
public function getAnos()
{
    return $this->anos;
}
public function setAnos($anos)
{
    $this->anos=$anos;
}

//Metodos

public function incremento($datos1, $fechaIngresada)
{
    $fechaEntera = strtotime($fechaIngresada);

    $anio = date("Y", $fechaEntera);
    $respuesta= $this->esBisiesto($anio);

    
    if ($respuesta==1){
      $nuevafecha = $this->incrementa_un_dia($fechaIngresada);
      $fechaIngresadaActual = date($nuevafecha);
    return  "fecha Ingresada:  ". $fechaIngresadaActual."\n".
                "dias ingresados: ".$datos1."\n".
              "Nueva fecha año bisiesto:  ".date("d-m-Y",strtotime($fechaIngresadaActual."+ $datos1 days"))."\n"; 
    }

    $fechaIngresadaActual = date($fechaIngresada);
    return  "fecha Ingresada:  ". $fechaIngresadaActual."\n".
               "dias ingresados: ".$datos1."\n".
              "Nueva fecha:  ".date("d-m-Y",strtotime($fechaIngresadaActual."+ $datos1 days"))."\n"; 


}
//funcion para obtener el año bisiesto
function esBisiesto($year=NULL) {
    $year = ($year==NULL)? date('Y'):$year;
    return ( ($year%4 == 0 && $year%100 != 0) || $year%400 == 0 );
}

public function incrementa_un_dia($fechaIngresa)
{
  $fecha = date($fechaIngresa);
  $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
   return $nuevafecha = date ( 'j-m-Y' , $nuevafecha );
  
}

public function __toString()
{

   setlocale(LC_ALL, "es_RA");
    $fechaACtual= $this->getAnos().'/'.$this->getMes().'/'.$this->getDias();
    
    $date = new DateTime($fechaACtual);
    $fecha = strftime("Fecha extendida %d de %B de %Y", $date->getTimestamp());
 
    return      'La fecha ingresada: '.$this->getDias().'/'.$this->getMes().'/'.$this->getAnos()."\n"
      .var_dump($fecha)."\n"; 
}

public function __destruct()
    {
    echo $this . " instancia destruida, no hay referencias a este objeto \n"; 
    }
}
?>
