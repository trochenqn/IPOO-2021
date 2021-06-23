<?php
class obramusical extends Funcion
{
    //variables
    private $director;
    private $cantPersonasEscena;
    private $porcentajeIncremento;

    //constructor
    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantPersonasEscena = "";
        $this->porcentajeIncremento = 12;
    }

    public function cargar($param){	
	    parent::cargar($param);
		$this->setDirector($param['director']);
        $this->setCantPersonasEscena($param['cantidadPersona']);
	}

    /*
	public function cargar($param)
    {
        $this->setidFuncion($param['id']);
        $this->setNombre($param['nombre_funcion']);
        $this->setPrecio($param['precio']);
        $this->setHoraInicio($param['horario_inicio']);
        $this->setDuracion($param['duracion']);
        $this->setid_teatro($param['objTeatro']);
		$this->setDirector($param['director']);
        $this->setCantPersonasEscena($param['cantidadPersona']);
    }*/

	//get y set
    public function getDirector()
    {
        return $this->director;
    }

    public function getCantPersonasEscena()
    {
        return $this->cantPersonasEscena;
    }

    public function getPorcentajeIncremento()
    {
        return $this->porcentajeIncremento;
    }

  
    public function setDirector($d)
    {
        $this->director = $d;
    }

    public function setCantPersonasEscena($cPE)
    {
        $this->cantPersonasEscena = $cPE;
    }

    public function setPorcentajeIncremento($pI)
    {
        $this->porcentajeIncremento = $pI;
    }

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
	
	public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

    /**
	 * Recupera los datos de la obra por el id 
	 * @param int $id
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($id){
		$base=new BaseDatos();
		$consulta="Select * from obramusical where idfuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($id);
                    $this->setDirector($row2['director']);
                    $this->setCantPersonasEscena($row2['cantPersona']);
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			 }
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	

    
	public static function listar($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from obramusical ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
	   	$consulta.=" order by director ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
                    $obj = new obramusical();
                  	$obj->Buscar($row2['idfuncion']);
					array_push($arreglo,$obj);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		
		if(parent::insertar()){
		    $consultaInsertar="INSERT INTO obramusical(idfuncion, director, cantPersona)
				VALUES (".parent::getidFuncion().",'".$this->getDirector()."','".$this->getCantPersonasEscena()."')";
                    
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp=  true;
		        }	else {
		            $this->setmensajeoperacion($base->getError());
		        }
		    } else {
		        $this->setmensajeoperacion($base->getError());
		    }
		 }
		return $resp;
	}

    
	public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica="UPDATE obramusical SET director='".$this->getDirector()."',cantPersona='".$this->getCantPersonasEscena()."'  WHERE idfuncion=".parent::getidFuncion()."";

	        if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp=  true;
	            }else{
	                $this->setmensajeoperacion($base->getError());
	                
	            }
	        }else{
	            $this->setmensajeoperacion($base->getError());
	            
	        }
	    }
		
		return $resp;
	}
	
    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM obramusical WHERE idfuncion=".parent::getidFuncion()."";
				if($base->Ejecutar($consultaBorra)){
				    if(parent::eliminar()){
				        $resp=  true;
				    }
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}


    public function __toString()
    {
        $cadena = parent::__toString() ;
       $cadena .=  "\n\tDirector: " . $this->getDirector() ;
       $cadena .= "\n\tCantidad de personas en escena: " . $this->getCantPersonasEscena() ;
       $cadena .= "\n\tPorcentaje de incremento: " . $this->getPorcentajeIncremento() . "%";

        return $cadena;
    }
}