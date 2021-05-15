<?php

class Teatro
{

    //variables
    private $nombreTeatro;
    private $direccionTeatro;
    private $colObjFuncion;
    private $funcion;
 
    // constructor
    public function __construct($n, $d, $colObjF)
    {
        $this->nombreTeatro = $n;
        $this->direccionTeatro = $d;

        $this->colObjFuncion = $colObjF;
        $this->funcion;
    }

    // Get y Set
    public function getNombreTeatro()
    {
        return $this->nombreTeatro;
    }

    public function setNombreTeatro($nombreTeatro)
    {
        $this->nombreTeatro = $nombreTeatro;
    }

    public function setDireccionTeatro($direccion)
    {
        $this->direccionTeatro = $direccion;
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

    public function setFuncion($numeroFuncion = 0)
    {
        $this->funcion = $numeroFuncion;
    }

  
    //Metodos
    /**
     * metodo para cambiar el nombre del teatro y direccion.
     */

    public function cambiarNombreTeatro_direccion($nombreNuevo = null, $direccion = null)
    {
        if (is_null($nombreNuevo)) {
            $this->setNombreTeatro($this->getNombreTeatro());
        } else {
            $this->setNombreTeatro($nombreNuevo);
        }
        if (is_null($direccion)) {

            $this->setDireccionTeatro($this->getDirecionTeatro());
        } else {
            $this->setDireccionTeatro($direccion);
        }

        return "El cambio se realizo con exito \n";
    }
    /**
     * metodo para cargar las cuatro funciones del teatro.
     */

    public function cargarFuncion($nombreFuncionNueva, $horarioInicio = null, $duracionObra = null, $precioFuncion = null)
    {
        $arrayFuncion = $this->getcolObjFuncion();
        $dato = count($arrayFuncion);
        $this->setFuncion($dato);
        if (count($arrayFuncion) >= 0) {
            if ($this->getFuncion() <= 3) {

                $arrayFuncion[$this->getFuncion()]["nombre"] = $nombreFuncionNueva;
                $this->setColObjFuncion($arrayFuncion);

                $arrayFuncion[$this->getFuncion()]["horarioInicio"] = $horarioInicio;
                $this->setColObjFuncion($arrayFuncion);

                $arrayFuncion[$this->getFuncion()]["duracionObra"] = $duracionObra;
                $this->setColObjFuncion($arrayFuncion);

                $arrayFuncion[$this->getFuncion()]["precio"] = $precioFuncion;
                $this->setColObjFuncion($arrayFuncion);

                if ($this->getFuncion() == 3) {
                    $this->setFuncion(0);
                    return "Se cargaron las cuatros funciones del dia" . print_r($arrayFuncion);
                }
            }
        }
    }

    public function verificarHorarioFuncion($hora)
    {
        $arrayFuncion = $this->getcolObjFuncion();
        $respuesta = array();
        $hsChequeoA = $hora["hs"];
        $minChequeoB = $hora["min"];

        if ($arrayFuncion == null && $hsChequeoA > 20) {

            $respuesta = [true, ["hs" => null, "min" => null]];
        } else {
            for ($i = 0; $i < count($arrayFuncion); $i++) {
                //   for ($j=0; $j<count($arrayFuncion[$i]); $j++){

               // $corroborar = $arrayFuncion[$i]["horarioInicio"];
               // $duracionObra = $arrayFuncion[$i]["duracionObra"];
               $corroborar = $arrayFuncion[$i]-> getHorarioInicio();
               $duracionObra = $arrayFuncion[$i]-> getDuracionObra();

                $hsCargado = $corroborar["hs"];
                $minCargado = $corroborar["min"];

                $hsDuracion = $duracionObra["hs"];
                $minDuracion = $duracionObra["min"];

                //sumar hora y min ARREGLAR ACA SUMA/////
                $sumarHoraA =  $hsCargado + $hsDuracion;
                $sumarMinB = $minCargado + $minDuracion;
               
                
               do{
                   $bandera=true;
                if ($sumarHoraA >= 0 && $sumarHoraA <= 23) {
                        
                    if ($sumarMinB  >= 0 && $sumarMinB  <= 59) {
                        $bandera = false;
                      
                    } else {
                         if ($sumarMinB >59){
                             $resto = $sumarMinB-59;
                             $sumarMinB =   $resto;
                             $sumarHoraA = $sumarHoraA +1;
                         }
                    }
                } else {
                    //---
                   if ($sumarHoraA>23){
                    $resto =  $sumarHoraA-23;
                    $sumarHoraA =  $resto;
                   }
                   
                   
                }
               }while($bandera);
                        
                   if ($hsChequeoA >= $sumarHoraA && $minChequeoB >= $sumarMinB) {
                    $respuesta = [true, ["hs" => null, "min" => null]];
                } else {
                    $respuesta = [false, ["hs" => $sumarHoraA, "min" => $sumarMinB]];
                }
                //  }

            }
        }

        return  $respuesta;
    }

    /**
     * modificar funcion y precio
     */
    public function modificarFuncion_precio($modificacion, $turno = null, $nombreFuncionMofificar = null,  $horarioInicio, $duracionObra, $precioFuncionModificar = null)
    {
        $arrayFuncion = $this->getcolObjFuncion();
       
        if ($modificacion === "A") {
            $arrayFuncion[$turno]["nombre"] = $nombreFuncionMofificar;
            $this->setColObjFuncion($arrayFuncion);
            $arrayFuncion[$turno]["horarioInicio"] = $horarioInicio;
            $this->setColObjFuncion($arrayFuncion);
            $arrayFuncion[$turno]["duracionObra"] = $duracionObra;
            $this->setColObjFuncion($arrayFuncion);
            $arrayFuncion[$turno]["precio"] = $precioFuncionModificar;
            $this->setColObjFuncion($arrayFuncion);
        } else {
            if ($this->getFuncion() <= 3) {
                $arrayFuncion[$turno]["nombre"] = $nombreFuncionMofificar;
                $this->setColObjFuncion($arrayFuncion);
                $arrayFuncion[$turno]["horarioInicio"] = $horarioInicio;
                $this->setColObjFuncion($arrayFuncion);
                $arrayFuncion[$turno]["duracionObra"] = $duracionObra;
                $this->setColObjFuncion($arrayFuncion);
                $arrayFuncion[$turno]["precio"] = $precioFuncionModificar;
                $this->setColObjFuncion($arrayFuncion);

                if ($this->getFuncion() == 3) {
                    return "Se modificaron con exito las funciones";
                    $this->setFuncion(0);
                }
            }
            $this->setFuncion($turno);
        }

 
    }

    

    public function borrarFunciones()
    {

        $arrayCarga = $this->getcolObjFuncion();

        if ($arrayCarga == NULL) {
            return 'No hay datos que borrar';
        } else {
            foreach ($arrayCarga as $key => $funciones) {

                unset($arrayCarga[$key]);

                $this->setColObjFuncion($arrayCarga);
            }
            return 'Se han borrado todas las funciones del dia';
        }
    }


    public function __toString()
    {
        return "Nombre de Teatro: " . $this->getNombreTeatro() . " -- Direccion: " . $this->getDirecionTeatro() . "\n 
   " . $this->mostrarFunciones();
    }

    public function mostrarFunciones()
    {
        $arrayFuncion = $this->getcolObjFuncion();
        $data = "";
        if ($arrayFuncion == NULL) {
            echo "se han borrado todas las funciones \n";
        } else {

            for ($i = 0; $i < count($arrayFuncion ); $i++) {
                // $suma = $suma + $colFuncion[$i]["precio"];
                $data .= "nombre: " . $arrayFuncion[$i]->getNombre()."\n";
                $hsInicio=  $arrayFuncion[$i]-> getHorarioInicio();
                $data .=  "Horario de Inicio: ". $hsInicio["hs"].":". $hsInicio["min"]." hs \n";
                $hsInicio=  $arrayFuncion[$i]-> getDuracionObra();
                $data .= "Duracion de la Obra: ".  $hsInicio["hs"] .":". $hsInicio["min"]." hs \n";
                $data .= "precio: $".  $arrayFuncion[$i]-> getPrecio()."\n";
                $data .= "--------------------------------------------\n";
            

            }
            
        }
        return $data;
    }


    function corroborarHorario()
    {
        do {
            $bandera = true;
            echo "Ingrese la Horas:\n";
            $horas = trim(fgets(STDIN));
            if (is_numeric($horas) && $horas >= 0 && $horas <= 23) {
                echo "Ingrese los Minutos:\n";
                $minutos = trim(fgets(STDIN));
                if (is_numeric($minutos) && $minutos >= 0 && $minutos <= 59) {
                    $bandera = false;
                    $horario = ["hs" => $horas, "min" => $minutos];
                } else {
                    echo "los minutos no son validos \n";
                }
            } else {
                echo "horas no es valida \n";
            }
        } while ($bandera);
        return $horario;
    }



    public function darCosto()
    {
        $colFuncion = $this->getcolObjFuncion();
        $porcentaje = 0;
        $suma = 0;
        //https://www.php.net/manual/es/function.cal-days-in-month.php

        $anioActual = date("Y");
        $mesActual = date("n");
        $cantidadDias = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);

        for ($i = 0; $i < count($colFuncion); $i++) {
            // $suma = $suma + $colFuncion[$i]["precio"];
            $suma = $suma + $colFuncion[$i]->getPrecio();
        }

        $precio = ($cantidadDias * $suma);

        if (get_class($this) == 'Teatro') {
            $this->$porcentaje= 45;
        } elseif(get_class($this) == 'teatroMusicales') {
            $this->porcentaje= 65;
        }   elseif (get_class($this) == 'teatroCine') {
            $this->porcentaje= 12;
        } 

        $porcentajeValor = ($precio * $this->porcentaje) / 100;
        $precioFinal = $precio + $porcentajeValor;

        return $precioFinal;
    }
}
