<?php


class teatroMusicales extends Teatro
{
    private $director;
    private $cantidadPersonaEscena;

    public function __construct($n, $d, $colObjF, $midirector, $micantidadPersonaEscena)
    {
        parent::__construct($n, $d, $colObjF);
        $this->director = $midirector;
        $this->cantidadPersonaEscena = $micantidadPersonaEscena;
    }

    public function getdirector()
    {
        return $this->director;
    }

    public function setdirector($midirector)
    {
        $this->director   = $midirector;
    }

    public function getcantidadPersonaEscena()
    {
        return $this->cantidadPersonaEscena;
    }

    public function setcantidadPersonaEscena($micantidadPersonaEscena)
    {
        $this->cantidadPersonaEscena   = $micantidadPersonaEscena;
    }

    public function __tostring()
    {
        $cadena = parent::__toString();
        $cadena .= "El director: " . $this->getdirector() . "\n";
        $cadena .= "Cantidad persona en escena: " . $this->getcantidadPersonaEscena() . "\n";

        return $cadena;
    }

    public function darCosto()
    {
       
        $importe = parent::darCosto();
    
        return $importe ;
    }
    
     /**
     * metodo para cargar las cuatro funciones del teatro.
     */

    public function cargarFuncionTeatro($nombreFuncionNueva, $horarioInicio, $duracionObra, $precioFuncion, $director, $cantidadPersonaEscena)
    {
        
        $variableRespues=null;

       parent::cargarFuncion($nombreFuncionNueva, $horarioInicio, $duracionObra, $precioFuncion);

        $arrayFuncion = parent::getcolObjFuncion();
        $dato = count($arrayFuncion);
        parent::setFuncion($dato);
        if (count($arrayFuncion) >= 0) {
            if (parent::getFuncion()-1 <= 3) {

                $arrayFuncion[parent::getFuncion()-1]["director"] = $director;
                parent::setColObjFuncion($arrayFuncion);

                $arrayFuncion[parent::getFuncion()-1]["cantidadPersonaEscena"] = $cantidadPersonaEscena;
                parent::setColObjFuncion($arrayFuncion);
               
                if (parent::getFuncion()-1 == 3) {
                    parent::setFuncion(0);
                    $variableRespues= "Se cargaron las cuatros funciones del dia" . print_r($arrayFuncion);
                }
            }
        }

       return $variableRespues;
      
    }

    public function verificarHorarioFuncion($hora)
    {
        

        $respuesta= parent::verificarHorarioFuncion($hora);
     
        return  $respuesta;
    }


    function corroborarHorario()
    {
        $horario= parent::corroborarHorario();

       
        return $horario;
    }


    public function borrarFunciones()
    {
            parent::borrarFunciones();
    }

     //Metodos
    /**
     * metodo para cambiar el nombre del teatro y direccion.
     */

    public function cambiarNombreTeatro_direccion($nombreNuevo = null, $direccion = null)
    {

        $horario= parent::cambiarNombreTeatro_direccion($nombreNuevo = null, $direccion = null);

       
        return $horario;
        
    }


    public function mostrarFunciones()
    {
       $data= parent::mostrarFunciones();

       return $data;
    }

}
