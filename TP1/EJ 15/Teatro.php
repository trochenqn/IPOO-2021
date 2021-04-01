<?php
class Teatro{

//variables
private $nombreTeatro;
private $direccionTeatro;
private $nombreFuncion;
private $precioFuncion=0; 
private $FuncionDia=array();

// constructor
public function __construct($n, $d, $nf, $pf, $array=null)
{
    $this->nombreTeatro = $n;
    $this->direccionTeatro= $d;
    $this->nombreFuncion=$nf;
    $this->precioFuncion=$pf;
    $this->FuncionDia= $array;
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

public function getFuncionDia()
{
    return $this->FuncionDia;
}

public function setFuncionDia($addFuncion)
{
    $this->FuncionDia = $addFuncion;
}

public function getNombreFuncion()
{
   return  $this->nombreFuncion;
}

public function getFuncionPrecio()
{
    return $this->precioFuncion;
}
//Metodos
public function cambiarNombreTeatro_direccion($nombreNuevo,$direccion)
{
    $this->setNombreTeatro($nombreNuevo);
    $this->setDireccionTeatro($direccion);
    return "El cambio se realizo con exito";
}

public function cargarFuncion($nombreFuncionNueva, $precioFuncionNuevo, $i)
{
    $arrayFuncion= $this->getFuncionDia();    
    
      $arrayFuncion[$i]["nombre"]= $nombreFuncionNueva;
      $this->setFuncionDia($arrayFuncion);
      $arrayFuncion[$i]["precio"]= $precioFuncionNuevo;
      $this->setFuncionDia($arrayFuncion);   
      if ($i==4){
             return "Se cargaron las cuatros funciones del dia";
         }
     
}

public function modificarFuncion_precio($modificacion, $turno=null, $nombreFuncionMofificar=null, $precioFuncionModificar=null)
{
    $arrayFuncion= $this->getFuncionDia();   

    if ($modificacion==="A"){
        $arrayFuncion[$turno]["nombre"]= $nombreFuncionMofificar;
        $this->setFuncionDia($arrayFuncion);
        $arrayFuncion[$turno]["precio"]= $precioFuncionModificar;
        $this->setFuncionDia($arrayFuncion);
    }else{
        $arrayFuncion[$turno]["nombre"]= $nombreFuncionMofificar;
        $this->setFuncionDia($arrayFuncion);
        $arrayFuncion[$turno]["precio"]= $precioFuncionModificar;
        $this->setFuncionDia($arrayFuncion);
        if ($turno==4){
            return "Se modificaron con exito las funciones";
        }
    }

  
}

public function mostrarFunciones()
{
    $arrayFuncion= $this->getFuncionDia(); 

    if ($arrayFuncion==NULL){
        echo "Funcion cargada:  ".$this->getNombreFuncion(). "- $ Precio: ".$this->getFuncionPrecio()." \n";
    }else{
        foreach($arrayFuncion as $array){
            foreach($array as $key => $value){
               
               echo  $key." ->".$value." \n";
           
           }
        }
    }
     
}

public function __toString()
{
   return "Nombre de Teatro: ".$this->getNombreTeatro()." -- Direccion: ". $this->getDirecionTeatro()."\n 
   ".$this->mostrarFunciones();
}

}

?>


