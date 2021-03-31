<?php
class Libro{

    //variables
private $titulo;
private $añoDeEdicion;
private $editorial;
private $nombre_ApellidoAutor;

 // private 
public function __construct($t, $ae, $e, $na)
{
    $this->titulo = $t;
    $this->añoDeEdicion = $ae;
    $this->editorial = $e;
    $this->nombre_ApellidoAutor = $na;
}

// Observadoras
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

public function set($variable)
{
    $this->variable= $variable;
}

//Metodos
public function perteneceEditorial($peditorial)
{
    return "El libro-> ".$peditorial." - ".(boolval($this->getEditorial()===$peditorial) ? 'True' : 'False')."\n ";
}

public function iguales($plibro, $parreglo)
{
    foreach($parreglo as $array){
        foreach($array as $key => $value){
            if($plibro===$value){
                return $mensaje = "El libro ".$plibro." se encuentra en la coleccion \n";
                break;
               }else{
                $mensaje = "El libro ".$plibro." no.. se encuentra en la coleccion \n";
              }
        }
    }
    return $mensaje;
}

public function aniosdesdeEdicion()
{
    $fechaActual = date ("Y");
    $años = $this->getAnoEdicion();
    return "A pasado -> ". date("y",strtotime('-'.$años.' year'.$fechaActual))." años de su edicion \n";
}

public function librodeEditoriales($arregloautor, $peditorial)
{
    foreach($arregloautor as $array){
          
        foreach($array as $key => $value){
            
            if($value===$peditorial){
                $arrayNuevo[]=  $array["libro"].$value; 
            }
        }
    }

    return $arrayNuevo;
}

public function __toString()
{
    return 
    "Titulo: ". $this->getTitulo()." \n 
    Año de Edicion: ".$this->getAnoEdicion()." \n
    Editorial: ".$this->getEditorial()." \n
    Apellido y Nombre del Autor: ".$this->getApellidoAutor()." \n";

}
}

?>
