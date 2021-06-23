<?php
class obrateatro extends Funcion
{
    //variables
    private $porcentajeIncremento;

    //constructor
    public function __construct()
    {
        parent::__construct();
        $this->porcentajeIncremento = 45;
    }


    public function cargar($param){	
	    parent::cargar($param);
	 
    }
 
    public function getPorcentajeIncremento()
    {
        return $this->porcentajeIncremento;
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
	 * Recupera los datos de una persona por dni
	 * @param int $dni
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idfuncion){
		$base=new BaseDatos();
		$consulta="Select * from obrateatro where idfuncion='".$idfuncion."'";
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($idfuncion);
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
		$consulta="Select * from obrateatro ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
	   //$consulta.=" order by carrera ";
		echo $consulta."----------\n";
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
                      $obj = new obrateatro();      
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
		    $consultaInsertar="INSERT INTO obrateatro(idfuncion )
				VALUES (".parent::getidFuncion().")";
                   
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
	        $consultaModifica="UPDATE obrateatro SET idfuncion='".$this->getidFuncion()."' WHERE idfuncion=".parent::getidFuncion()."";
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
				$consultaBorra="DELETE FROM obrateatro WHERE idfuncion=".parent::getidFuncion()."";
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
        return parent::__toString() . 
        "\n\tPorcentaje de incremento: " . $this->getPorcentajeIncremento() . "%";
    }
}