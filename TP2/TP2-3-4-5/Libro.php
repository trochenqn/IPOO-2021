<?php

class Libro{

    //variables
private $isbn;
private $titulo;
private $añoDeEdicion;
private $editorial;
private $nombre_ApellidoAutor;
private $cantidadPagina;
private $SinopsisLibro;

 // private 
public function __construct($i, $t, $ae, $e, $na, $cp, $sl)
{
    $this->isbn= $i;
    $this->titulo = $t;
    $this->añoDeEdicion = $ae;
    $this->editorial = $e;
    $this->nombre_ApellidoAutor = $na;
    $this->cantidadPagina= $cp;
    $this->SinopsisLibro= $sl;
}

// Observadoras
public function getIsbn()
{
    return $this->isbn;
}
public function getAnoEdicion()
{
    return $this->añoDeEdicion;
}
public function getEditorial()
{
    return $this->editorial;
}
public function getTitulo()
{
    return $this->titulo;
}

public function getApellidoAutor()
{
    return $this->nombre_ApellidoAutor;
}

public function getCantidadpagina()
{
    return $this->cantidadPagina;
}

public function set($variable)
{
    $this->variable= $variable;
}

public function getSinopsisLibro()
{
    return $this->SinopsisLibro;
}
//Metodos
/**
 * indica si el libro pertenece a una editorial dada. recibe como parametro una editorial
 * y devuelve un valor true/false;
 */
public function perteneceEditorial($peditorial)
{
    return (boolval($this->getEditorial()===$peditorial) ? True : False);
}
/**
 * dada una coleccion de libros, indica si el libro pasado por parametro ya se encuentra en dicha 
 * coleccion
 */
public function iguales($plibro, $parreglo)
{
   
    foreach($parreglo as $array){
                 
      if($array == $plibro){
        return $mensaje = "El libro  se encuentra en la coleccion \n";
        break;
         }else{
            $mensaje = "El libro  no.. se encuentra en la coleccion \n";
        }
    }
    return $mensaje;
}

/**
 * el metodo retorna los años que se han pasado desde que el libro fue editado.
 */
public function aniosdesdeEdicion()
{
    $fechaActual = date ("Y");
    $años = $this->getAnoEdicion();
    return "A pasado -> ". date("Y",strtotime('-'.$años.' year'.$fechaActual))." años de su edicion \n";
}

/**
 * metodo que retorna un arreglo asociativo con todos los libros publicados por la editorial 
 * dada.
 */
public function librodeEditoriales($arregloautor, $peditorial)
{
   
    foreach($arregloautor as $array){
          
        if($array->getEditorial() == $peditorial){
            $arrayNuevo[]=  $array->getTitulo(); 
        }
     
    }

    return $arrayNuevo;
}

public function __toString()
{   
   
    $cadena= "ISBN: ". $this->getIsbn()." \n"; 
    $cadena= $cadena. "Titulo: ". $this->getTitulo()." \n";
    $cadena= $cadena. " Año de Edicion: ".$this->getAnoEdicion()." \n";
    $cadena= $cadena. " Editorial: ".$this->getEditorial()." \n";
    $cadena= $cadena. " Apellido y Nombre del Autor: ".$this->getApellidoAutor()." \n";
    $cadena= $cadena. " cantidad pagina: ".$this->getCantidadpagina()." \n";

    return  $cadena;

}
}

?>
