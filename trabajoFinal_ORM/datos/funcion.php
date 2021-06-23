<?php
include_once "BaseDatos.php";
class Funcion
{
    //variables
    private $idFuncion;
    private $nombre;
    private $precio;
    private $horaInicio;
    private $duracion;
    private $objTeatro;
    
    //constructor
    public function __construct()
    {
        //La duracion de la funcion es en minutos
        $this->idFuncion = 0;
        $this->nombre = "";
        $this->precio = "";
        $this->horaInicio = "";
        $this->duracion = "";
        $this->objTeatro;
     }

    public function cargar($param)
    {
        $this->setidFuncion($param['id']);
        $this->setNombre($param['nombre_funcion']);
        $this->setPrecio($param['precio']);
        $this->setHoraInicio($param['horario_inicio']);
        $this->setDuracion($param['duracion']);
        //aca tiene que ir el objeto teatro??
        $this->setObjeTeatro($param['objTeatro']);
    }

/*
    public function cargar()
    {
        $this->setId($param['id']);
        $this->setNombre_Funcion($param['nombre_funcion']);
        $this->setHorario_Inicio($param['horario_inicio']);
        $this->setDuracion($param['duracion']);
        $this->setPrecio($param['precio']);
        $this->setTipoFuncion($param['tipoFuncion']);
        $this->setId_teatro($param['objTeatro']);
    }*/
    //get y set
    public function getidFuncion()
    {
        return $this->idFuncion;
    }

    public function setidFuncion($miidFuncion)
    {
        $this->idFuncion = $miidFuncion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

 
    public function setNombre($n)
    {
        $this->nombre = $n;
    }

    public function setPrecio($p)
    {
        $this->precio = $p;
    }

    public function setHoraInicio($hI)
    {
        $this->horaInicio = $hI;
    }

    public function setDuracion($d)
    {
        $this->duracion = $d;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function getObjeTeatro()
    {
        return $this->objTeatro;
    }

    public function setObjeTeatro($objTeatro)
    {
        $this->objTeatro = $objTeatro;
    }

    //Metodos
    /**
     * Recupera una funcion por nombre de funcion
     * @param varchar $nombre
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function Buscar($idFuncion)
    {
        $base = new BaseDatos();
        $consultaPersona = "Select * from  funcion  where idfuncion ='". $idFuncion ."';";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) {
                    $this->setidFuncion($idFuncion);
                    $this->setNombre($row2['nombreFuncion']);
                    $this->setHoraInicio($row2['horarioFuncion']);
                    $this->setDuracion($row2['horarioDuracion']);
                    $this->setPrecio($row2['precio']);
                    //teatro    
                    $miTeatro = new Teatro();
                    $miTeatro->BuscarId($row2['id_teatro']);

                    $this->setObjeTeatro($miTeatro);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public static function listar($condicion = "")
    {
        $arregloFuncion = null;
        $base = new BaseDatos();
        $consultaFuncion = "Select * from funcion ";
        if ($condicion != "") {
            $consultaFuncion = $consultaFuncion . ' where ' . $condicion;
        }
        $consultaFuncion .= " order by idfuncion ";
       // echo $consultaFuncion;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {
                                       
                        $funcion = new Funcion();
                        $funcion->Buscar($row2['idfuncion']);

                        array_push($arregloFuncion, $funcion);
    

                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloFuncion;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $objTeatro = $this->getObjeTeatro();
        $idteatro =  $objTeatro->getidteatro();
        $consultaInsertar = "INSERT INTO funcion(nombreFuncion, horarioFuncion, horarioDuracion, precio, id_teatro) 
				VALUES ('" . $this->getNombre() . "','" . $this->getHoraInicio() . "','" . $this->getDuracion() . "','" . $this->getPrecio() . "','" . $idteatro . "')";
           
        if ($base->Iniciar()) {
            $id = $base->devuelveIDInsercion($consultaInsertar);
            if (!is_null($id)) {
                $this->setidFuncion($id);
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objTeatro = $this->getObjeTeatro();
        $idTeatro =  $objTeatro->getidteatro();
      
        $consultaModifica = "UPDATE funcion SET nombreFuncion='" . $this->getNombre() . "', horarioFuncion='" . $this->getHoraInicio() . "'
                           , horarioDuracion='" . $this->getDuracion() . "', precio='" . $this->getPrecio() . "',id_teatro='" . $idTeatro. "' WHERE idfuncion=" . $this->getidFuncion() . "";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM funcion WHERE idfuncion=" . $this->getidFuncion() . "";
            if ($base->Ejecutar($consultaBorra)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    public function __toString()
    {
        $cadena = "ID obra de funciones: ".$this->getidFuncion()."\n";
        $cadena .= "\tNombre: " . $this->getNombre();
        $cadena .= "\n\tPrecio: $" . $this->getPrecio() ;
        $cadena .= "\n\tHora inicio: " . $this->getHoraInicio();
        $cadena .= "\n\tDuracion: " . $this->getDuracion();
        $cadena .=  "\n\t - teatro: ". $this->getObjeTeatro();  

            return $cadena;
    }
 
}
