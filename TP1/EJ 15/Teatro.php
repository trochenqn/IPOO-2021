<?php
class Teatro{

//variables
private $nombreTeatro;
private $direccionTeatro;
private $nombreFuncion;
private $precioFuncion=0; 
private $FuncionDia=array();
private $funcion;

// constructor
public function __construct($n, $d, $nf, $pf, $array=null)
{
    $this->nombreTeatro = $n;
    $this->direccionTeatro= $d;
    $this->nombreFuncion=$nf;
    $this->precioFuncion=$pf;
    $this->FuncionDia= $array;
    $this->funcion=0;
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
public function getFuncion()
{
    return $this->funcion;
}

public function setFuncion($numeroFuncion=0)
{
    $this->funcion= $numeroFuncion;
}
//Metodos
public function cambiarNombreTeatro_direccion($nombreNuevo,$direccion)
{
    $this->setNombreTeatro($nombreNuevo);
    $this->setDireccionTeatro($direccion);
    return "El cambio se realizo con exito";
}

public function cargarFuncion($nombreFuncionNueva, $precioFuncionNuevo)
{
    $arrayFuncion= $this->getFuncionDia();    
    
    if ($this->getFuncion()<=3){
      $arrayFuncion[$this->getFuncion()]["nombre"]= $nombreFuncionNueva;
      $this->setFuncionDia($arrayFuncion);
      $arrayFuncion[$this->getFuncion()]["precio"]= $precioFuncionNuevo;
      $this->setFuncionDia($arrayFuncion);   
      if ($this->getFuncion()==3){
        $this->setFuncion(0);
          return "Se cargaron las cuatros funciones del dia";
         }
         $this->setFuncion($this->getFuncion()+1);
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
    if ($this->getFuncion()<=3){
        $arrayFuncion[$turno]["nombre"]= $nombreFuncionMofificar;
        $this->setFuncionDia($arrayFuncion);
        $arrayFuncion[$turno]["precio"]= $precioFuncionModificar;
        $this->setFuncionDia($arrayFuncion);
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

public function borrarFunciones()
{
    if($this->FuncionDia==NULL){
        return 'No hay datos que borrar';
    }else{
        foreach ($this->FuncionDia as $key => $funciones) {
            unset($this->FuncionDia[$key]);
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


