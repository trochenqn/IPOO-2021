<?php
class lectura{
 //variables
private $libro;
private $paginaActual;
private $librosLeidos;


public function __construct($l, $pl, $ll=null)
{
    $this->libro = $l;
    $this->paginaActual= $pl;
    $this->librosLeidos= $ll;
    
}
 //GET Y SET

 public function getLibro()
{
    return $this->libro;
}

public function setLibrol($l)
{
    $this->libro= $l;
}
public function getPaginaActual()
{
    return $this->paginaActual;
}

public function setPaginaActual($pl)
{
    $this->paginaActual= $pl;
}
public function getLibrosLeidos()
{
    return $this->librosLeidos;
}

public function setLibrosLeidos($librosl)
{
    $this->librosLeidos= $librosl;
}

//METODOS

 public function siguientePagina()
 {
     $paginaActual = $this->getPaginaActual();
     $cargarTotalPagina = $this->getLibro()->getCantidadpagina();

     if ($paginaActual<$cargarTotalPagina){
         $paginaActual++;
         $this->setPaginaActual($paginaActual);
     }

     return $paginaActual;

 }

 public function retrocederPagina()
 {
    $paginaActual = $this->getPaginaActual();
   

    if ($paginaActual>1){
        $paginaActual--;
        $this->setPaginaActual($paginaActual);
    }

    return $paginaActual;
 }

 public function irPagina($x)
 {
    
     $cargarTotalPagina = $this->getLibro()->getCantidadpagina();

     if ($x <= $cargarTotalPagina && $x >0){
        $this->setPaginaActual($x);
    }
  
 }

 /**
  * retorna true si el libro cuyo titulo recibido por parametro se encuentra dentro del conjunto
  *de libros leidos y false en caso contrario
  */

 public function libroLeido($titulo)
 {
    $arrayLibrosLeidos= $this->getLibrosLeidos();

    for ($i=0; $i<count($arrayLibrosLeidos); $i++){
        
        for ($j=0; $j<count($arrayLibrosLeidos[$i]); $j++){
            if ($arrayLibrosLeidos[$i][$j]==$titulo){
                return true;
            }else{
                return false;
            }
        }
        
    }
}

 /**
  * retorna la sipnosis del libro cuyo titulo se recibe por parametros.
  */

 public function darSinopsis($titulo)
 {
    $arrayLibrosLeidos= $this->getLibrosLeidos();

    for ($i=0; $i<count($arrayLibrosLeidos); $i++){
        
        for ($j=0; $j<count($arrayLibrosLeidos[$i]); $j++){
            if ($arrayLibrosLeidos[$i][$j]==$titulo){
                return $arrayLibrosLeidos[$i][3];
            }else{
                return "▓ No se encuentra el libro ▓\n";;
            }
        }
    }
}

/**
 * Que retorne todos aquellos libros que fueron leidos y su año de edicion 
 * en un año X recibido por parametros.
 */

 public function leidosAnioEdicion($x)
 {
    $arrayLibrosLeidos= $this->getLibrosLeidos();
    $resul= array();
    for ($i=0; $i<count($arrayLibrosLeidos); $i++){
        
        for ($j=0; $j<count($arrayLibrosLeidos[$i]); $j++){
              if ($arrayLibrosLeidos[$i][$j]==$x){
                $resul[] = array ($arrayLibrosLeidos[$i][0], $arrayLibrosLeidos[$i][2]);
           
            }
        }
    }
   
    return  $resul;
 }
 /**
  * retorna todos aquellos libros que fueron leidos y el nombre de su autor 
  * coincide con el recibido por el parametro
  */
 public function darLibrosPorAutor($nombreAutor)
 {
    $arrayLibrosLeidos= $this->getLibrosLeidos();
    $resul= array();
     for ($i=0; $i<count($arrayLibrosLeidos); $i++){
       for ($j=0; $j<count($arrayLibrosLeidos[$i]); $j++){
              if ($arrayLibrosLeidos[$i][$j]===$nombreAutor){
               $resul[]=  array($arrayLibrosLeidos[$i][0], $arrayLibrosLeidos[$i][1]);
            }
        }
    }
  return $resul;

 }

 public function __toString()
 {
    $cadena = "El libro ". $this->getLibro()."\n";
    $cadena = $cadena. " esta en la pagina actual ".$this->getPaginaActual()."\n";
    return $cadena;
 }

}

?>