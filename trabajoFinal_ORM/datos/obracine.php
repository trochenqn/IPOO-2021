<?php

class obracine extends Funcion
{
    //variables
    private $genero;
    private $paisOrigen;
    private $porcentajeIncremento;

    //constructor
    public function __construct()
    {
        parent::__construct();
        $this->genero = "";
        $this->paisOrigen = "";
        $this->porcentajeIncremento = 65;
    }

    public function cargar($param){	
	    parent::cargar($param);
		$this->setGenero($param['genero']);
        $this->setPaisOrigen($param['paisorigen']);
	 
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
		$this->setGenero($param['genero']);
        $this->setPaisOrigen($param['paisorigen']);

		
    }*/

    //get y set
    public function getGenero()
    {
        return $this->genero;
    }

    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    public function getPorcentajeIncremento() {
        return $this->porcentajeIncremento;
    }

 
    public function setGenero($g)
    {
        $this->genero = $g;
    }

    public function setPaisOrigen($pO)
    {
        $this->paisOrigen = $pO;
    }

    public function setPorcentajeIncremento($pI) {
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
		$consulta="Select * from obracine where idfuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($id);
                    $this->setGenero($row2['genero']);
                    $this->setPaisOrigen($row2['paisOrigen']);
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
		$consulta="Select * from obracine ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
	   	$consulta.=" order by genero ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
                    $obj = new obracine();
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
		    $consultaInsertar="INSERT INTO obracine(idfuncion, genero, paisOrigen)
				VALUES (".parent::getidFuncion().",'".$this->getGenero()."','".$this->getPaisOrigen()."')";
                    
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
	        $consultaModifica="UPDATE obracine SET genero='".$this->getGenero()."',paisOrigen='".$this->getPaisOrigen()."'  WHERE idfuncion=".parent::getidFuncion()."";

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
				$consultaBorra="DELETE FROM obracine WHERE idfuncion=".parent::getidFuncion()."";
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



    public function __toString() {
        $cadena=  parent::__toString() ; 
        $cadena .=  "\n\tGenero: " . $this->getGenero() ;
        $cadena .= "\n\tPais de origen: " . $this->getPaisOrigen();
        $cadena .= "\n\tPorcentaje de incremento: " . $this->getPorcentajeIncremento() . "%";

        return $cadena; 
    }
}