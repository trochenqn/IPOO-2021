<?php

class teatroCine extends Teatro
{
    private $genero;
    private $paisOrigen;

    public function __construct($n, $d, $colObjF, $miGenero, $miPaisOrigin)
    {
        parent::__construct($n, $d, $colObjF);
        $this->genero = $miGenero;
        $this->paisOrigen = $miPaisOrigin;
    }

    public function getgenero()
    {
        return $this->genero;
    }

    public function setgenero($migenero)
    {
        $this->genero    = $migenero;
    }

    public function getpaisOrigen()
    {
        return $this->paisOrigen;
    }

    public function setpaisOrigen($mipaisOrigen)
    {
        $this->paisOrigen    = $mipaisOrigen;
    }

    public function __tostring()
    {
        $cadena = parent::__toString();
        $cadena .= "El genero: " . $this->getgenero() . "\n";
        $cadena .= "Pais de origen: " . $this->getpaisOrigen() . "\n";

        return $cadena;
    }

    public function darCosto()
    {

     $importe = parent::darCosto();
       
        return   $importe ;
    }


     /**
     * metodo para cargar las cuatro funciones del teatro.
     */

    public function cargarFuncionCine($nombreFuncionNueva, $horarioInicio, $duracionObra, $precioFuncion, $genero, $paisOrigen)
    {
        
        $variableRespues=null;

       parent::cargarFuncion($nombreFuncionNueva, $horarioInicio, $duracionObra, $precioFuncion);

        $arrayFuncion = parent::getcolObjFuncion();
        $dato = count($arrayFuncion);
        parent::setFuncion($dato);
        if (count($arrayFuncion) >= 0) {
            if (parent::getFuncion()-1 <= 3) {

                $arrayFuncion[parent::getFuncion()-1]["genero"] = $genero;
                parent::setColObjFuncion($arrayFuncion);

                $arrayFuncion[parent::getFuncion()-1]["paisOrigen"] = $paisOrigen;
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
