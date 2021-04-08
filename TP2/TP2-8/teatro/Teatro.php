<?php
class Teatro{

//variables
private $nombreTeatro;
private $direccionTeatro;
private $colObjFuncion;
private $funcion;

// constructor
public function __construct($n, $d, $colObjF)
{
    $this->nombreTeatro = $n;
    $this->direccionTeatro= $d;
 
    $this->colObjFuncion= $colObjF;
    $this->funcion;
}

// Get y Set
public function getNombreTeatro()
{
    return $this->nombreTeatro;
}

public function setNombreTeatro($nombreTeatro)
{
    $this->nombreTeatro= $nombreTeatro;
}

public function setDireccionTeatro($direccion)
{
    $this->direccionTeatro= $direccion;
}
public function getDirecionTeatro()
{
    return $this->direccionTeatro;
}

public function getcolObjFuncion()
{
    return $this->colObjFuncion;
}

public function setColObjFuncion($COFunciones)
{
    $this->colObjFuncion = $COFunciones;
}

//--------parametro interno------------
public function getFuncion()
{
    return $this->funcion;
}

public function setFuncion($numeroFuncion=0)
{
    $this->funcion= $numeroFuncion;
}
//Metodos
/**
 * metodo para cambiar el nombre del teatro y direccion.
 */

public function cambiarNombreTeatro_direccion($nombreNuevo=null,$direccion=null)
{
    if (is_null($nombreNuevo)){
        $this->setNombreTeatro( $this->getNombreTeatro());
    }else{
        $this->setNombreTeatro($nombreNuevo);
    }
    if (is_null($direccion)){

        $this->setDireccionTeatro( $this->getDirecionTeatro());
    }else{
        $this->setDireccionTeatro($direccion);
    }
    return "El cambio se realizo con exito \n";
}
/**
 * metodo para cargar las cuatro funciones del teatro.
 */

public function cargarFuncion($nombreFuncionNueva, $horarioInicio=null, $duracionObra=null, $precioFuncion=null)
{
    $arrayFuncion= $this->getcolObjFuncion();  
    $dato= count($arrayFuncion);
    $this->setFuncion($dato);
    if (count($arrayFuncion)>=0){
        if ($this->getFuncion()<=3){
          
          $arrayFuncion[$this->getFuncion()]["nombre"]= $nombreFuncionNueva;
          $this->setColObjFuncion($arrayFuncion);
    
          $arrayFuncion[$this->getFuncion()]["horarioInicio"]= $horarioInicio;
          $this->setColObjFuncion($arrayFuncion);  
          
          $arrayFuncion[$this->getFuncion()]["duracionObra"]= $duracionObra;
          $this->setColObjFuncion($arrayFuncion);
    
          $arrayFuncion[$this->getFuncion()]["precio"]= $precioFuncion;
          $this->setColObjFuncion($arrayFuncion);
    
          if ($this->getFuncion()==3){
            $this->setFuncion(0);
              return "Se cargaron las cuatros funciones del dia".print_r($arrayFuncion);
             }
        }
    }
}

public function verificarHorarioFuncion($hora)
{
    $arrayFuncion= $this->getcolObjFuncion();  
    
    for ($i=0; $i<count($arrayFuncion); $i++){
        //   for ($j=0; $j<count($arrayFuncion[$i]); $j++){
               
                $corroborar= $arrayFuncion[$i]->getHorarioInicio();
                $duracionObra= $arrayFuncion[$i]->getDuracionObra();
                         
                $hsCargado = $corroborar["hs"];
                $minCargado= $corroborar["min"];

                $hsDuracion = $duracionObra["hs"];
                $minDuracion= $duracionObra["min"];
                //sumar hora y min
                $sumarHoraA=  $hsCargado + $hsDuracion;
                $sumarMinB= $minCargado +$minDuracion;
                $hsChequeoA = $hora["hs"];
                $minChequeoB= $hora["min"];

               if($hsChequeoA >= $sumarHoraA && $minChequeoB >=$sumarMinB){
                    $respuesta = array(true, [null, null]);
                    return $respuesta;
                }else{
                    $respuesta = array(false, [$sumarHoraA, $sumarMinB]);
                    return  $respuesta;
                }
         //  }
            
        }
}

public function modificarFuncion_precio($modificacion, $turno=null, $nombreFuncionMofificar=null,  $horarioInicio, $duracionObra, $precioFuncionModificar=null)
{
    $arrayFuncion= $this->getcolObjFuncion();  

    if ($modificacion==="A"){
        $arrayFuncion[$turno]["nombre"]= $nombreFuncionMofificar;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["horarioInicio"]= $horarioInicio;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["duracionObra"]= $duracionObra;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["precio"]= $precioFuncionModificar;
        $this->setColObjFuncion($arrayFuncion);
    }else{
    if ($this->getFuncion()<=3){
        $arrayFuncion[$turno]["nombre"]= $nombreFuncionMofificar;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["horarioInicio"]= $horarioInicio;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["duracionObra"]= $duracionObra;
        $this->setColObjFuncion($arrayFuncion);
        $arrayFuncion[$turno]["precio"]= $precioFuncionModificar;
        $this->setColObjFuncion($arrayFuncion);

        if ($this->getFuncion()==3){
            return "Se modificaron con exito las funciones";
            $this->setFuncion(0);
        }
     }
     $this->setFuncion($turno);
    }

  
}

public function mostrarFunciones()
{
    $arrayFuncion= $this->getcolObjFuncion();  

    if ($arrayFuncion==NULL){
        echo "se han borrado todas las funciones \n";
    }else{
        foreach($arrayFuncion as $array){
            foreach($array as $key => $value){
               
               echo  $key." ->". print_r($value)." \n";
           
           }
        }
    }
     
}

public function borrarFunciones()
{
    
    $arrayCarga = $this->getcolObjFuncion();
    
    if($arrayCarga ==NULL){
        return 'No hay datos que borrar';
    }else{
        foreach ($arrayCarga as $key => $funciones) {
           
            unset($arrayCarga[$key]);
          
            $this->setColObjFuncion($arrayCarga);
           }
      return 'Se han borrado todas las funciones del dia';
    }
}


public function __toString()
{
   return "Nombre de Teatro: ".$this->getNombreTeatro()." -- Direccion: ". $this->getDirecionTeatro()."\n 
   ".$this->mostrarFunciones();
}

}

?>


