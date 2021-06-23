<?php
include_once "BaseDatos.php";

class Teatro
{
    //variables
    private $idteatro;
    private $nombre;
    private $direccion;
    private $arregloFunciones;
    private $mensajeoperacion;


    //constructor
    public function __construct()
    {
        $this->idteatro = "";
        $this->nombre = "";
        $this->direccion = "";
        $this->arregloFunciones = [];
    }

    //get y set

    public function cargar($idteatro, $n, $d)
    {
        $this->setidteatro($idteatro);
        $this->setNombre($n);
        $this->setDireccion($d);
    }

    public function getidteatro()
    {
        return $this->idteatro;
    }

    public function setidteatro($idteatro)
    {
        $this->idteatro = $idteatro;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
    //se cargan todas la funciones de la BD
    public function getarregloFunciones()
    {
        if (count($this->arregloFunciones) == 0) {
            $objteatro = new obrateatro();
            $objcine = new obracine();
            $objmusical = new obramusical();
            //completa la coleccion por el ID del teatro.
            $condicion = $this->getidteatro();
            
            $colTeatro =    $objteatro->listar($condicion);
            $colCine =    $objcine->listar($condicion);
            $colMusical =    $objmusical->listar($condicion);
            $coleccionFunciones = array_merge($colTeatro, $colCine, $colMusical);
            $this->setarregloFunciones($coleccionFunciones);
        }

            return $this->arregloFunciones;
    }

    public function setNombre($n)
    {
        $this->nombre = $n;
    }

    public function setDireccion($d)
    {
        $this->direccion = $d;
    }

    public function setarregloFunciones($aF)
    {
        $this->arregloFunciones = $aF;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }


    //Metodos
    /**
     * Recupera una funcion por nombre de funcion
     * @param varchar $nombre
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function Buscar($nombreTeatro)
    {
        $base = new BaseDatos();
        $consultaTeatro = "Select * from  teatro  where nombreTeatro ='" . $nombreTeatro . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                if ($row2 = $base->Registro()) {
                    $this->setidteatro($row2['idteatro']);
                    $this->setNombre($nombreTeatro);
                    $this->setDireccion($row2['direccionTeatro']);

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

    //Metodos
    /**
     * Recupera una funcion por nombre de funcion
     * @param varchar $nombre
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function BuscarId($id)
    {
        $base = new BaseDatos();
        $consultaTeatro = "Select * from  teatro  where idteatro ='" . $id . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                if ($row2 = $base->Registro()) {
                    $this->setidteatro($id);
                    $this->setNombre($row2['nombreTeatro']);
                    $this->setDireccion($row2['direccionTeatro']);

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
        $consultaTeatro = "Select * from teatro ";
        if ($condicion != "") {
            $consultaTeatro = $consultaTeatro . ' where ' . $condicion;
        }
        $consultaTeatro .= " order by nombreTeatro ";
        //echo $consultaTeatro;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {

                    $idteatro = $row2['idteatro'];
                    $Nombre = $row2['nombreTeatro'];
                    $direccion = $row2['direccionTeatro'];

                    $teatro = new Teatro();
                   // $teatro->Buscar($row2['idteatro']);
                    $teatro->cargar($idteatro, $Nombre, $direccion);
                    array_push($arregloFuncion, $teatro);
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
        $consultaInsertar = "INSERT INTO teatro(nombreTeatro, direccionTeatro) 
				VALUES ('" . $this->getNombre() . "', '" . $this->getDireccion() . "')";

        if ($base->Iniciar()) {

            if ($base->Ejecutar($consultaInsertar)) {

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
        $consultaModifica = "UPDATE teatro SET nombreTeatro='" . $this->getNombre() . "',direccionTeatro='" . $this->getDireccion() . "'
                           WHERE idteatro='" . $this->getidteatro() . "'";
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
            $consultaBorra = "DELETE FROM teatro WHERE idteatro='" . $this->getidteatro() . "'";
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

    // funcion __toString()
    public function __toString()
    {
        $cadena = "\nId del teatro: " . $this->getidteatro();
        $cadena .=  "\n\tTeatro: " . $this->getNombre();
        $cadena .= "\n\tDireccion: " . $this->getDireccion();
      //   $cadena .= "\n\tFunciones:\n" . $this->funcionesAString();

        return $cadena;
    }

      private function funcionesAString()
    {
        $retorno = "";
        $arreglo = $this->getarregloFunciones();
       if(count($arreglo) ==0){
        $retorno .= "No hay registros de funciones \n"; 
       } else{
        foreach ($arreglo as $i) {
                $retorno .= $i . "\n";
                $retorno .= "<<<<<<<<<*************************>>>>>>>>>\n";
            }
        }
        return $retorno;
    }


    public function controlSolapamiento($array_recibeFuncion,  $tipoObra)
    {
        $bandera = false;
        $i = 0;
   
        //se agrega un array vasio para recargar el getarregloFunciones()
        $arrayCarga = [];
        // $this->setarregloFunciones($arrayCarga);
        $objTeatro = $array_recibeFuncion['objTeatro'];
        $objTeatro->BuscarId($objTeatro->getidteatro());
        $colFunciones = $this->getarregloFunciones();

            while ($i < count($colFunciones) && !$bandera) {
            //primero chequer que el teatro sea igual al requerido, ya que el programa se puede cargar varios teatros
            //comparar que sea la clase objeto correcta obra teatro, cine o musical

            $array_objTeatro = $colFunciones[$i]->getObjeTeatro();

            if ($objTeatro->getidteatro() == $array_objTeatro->getidteatro()) {

                $tipoClase = get_class($colFunciones[$i]);
               
        
                if ($tipoClase == $tipoObra) {
                    //si ambas funciones son iguales no ingresa.-

                    if ($array_recibeFuncion['nombre_funcion'] != $colFunciones[$i]->getNombre()) {
                        //***************************************************** */
                        //de la coleccion de la funcion las (hh:mm) los pasamos minutos fines para poder corroborar el solapamiento.
                        #(1)DURACION
                        $duracionminutos = $this->conversionHora_munutos($colFunciones[$i]->getDuracion());

                        #(2)HORA MINUTOS
                        $minutosfuncion =  $this->conversionHora_munutos($colFunciones[$i]->getHoraInicio());
                        //sumo el total de minutos duracion y los minutos de duracion

                        $totalminutos = $duracionminutos + $minutosfuncion;
                        //****************************************************** */
                        $funcionminutosTeatro =  $this->conversionHora_munutos($array_recibeFuncion['horario_inicio']);
                        $funcionminutosDureacionTeatro =  $this->conversionHora_munutos($array_recibeFuncion['duracion']);

                        if ($funcionminutosTeatro > $totalminutos || $minutosfuncion > ($funcionminutosTeatro + $funcionminutosDureacionTeatro)) {
                            $bandera = false;
                        } else {
                            $bandera = true;
                        }
                    }
                }
            }

            $i++;
        }
        return $bandera;
    }

    //***************************************************** */
    # funcion que recibe la duracion de la coleccion de la funcion y convierto la hora (hh:mm) a minutos
    public function conversionHora_munutos($hora)
    {
        //realizamos una partición que separe la parte de la hora y la parte de los minutos
        $v_horaParte = explode(":", $hora);
        $hs = (int) $v_horaParte[0];
        $min = (int) $v_horaParte[1];

        //la parte de la hora la multiplicamos por 60 para pasarla a minutos y así realizar la suma de los minutos totales
        $minutostotales = ($hs * 60) + $min;

        return $minutostotales;
    }


    public function existeFuncion($funcionBuscada )
    {
        $bandera = -1;
        $i = 0;
        $colFunciones = $this->getarregloFunciones();
        while ($i < count($colFunciones) && $bandera == -1) {
            if ($colFunciones[$i]->getNombre() == $funcionBuscada) {
                $bandera = $i;
            } else {
                $i++;
            }
        }
        return $bandera;
    }

    public function darCostos()
    {
        $pruebacine = new obracine();
        $pruebateatro = new obrateatro();
        $pruebamusical = new obramusical();

        $arregloFunciones = $this->getarregloFunciones();

        $registro = count($arregloFunciones);

        echo ("Se registran un total de: " .  $registro . " registros cargados en el sistema \n");

        // $arregloFunciones = $this->getFunciones();
        $costoTeatro = 0;
        $costoCine = 0;
        $costoMusical = 0;
        $costoTotal = 0;
        foreach ($arregloFunciones as $objFuncion) {

            $preciolaFuncion = $objFuncion->getPrecio();
            $id = $objFuncion->getidFuncion();

            $respcine =  $pruebacine->Buscar($id);
            $respteatro =  $pruebateatro->Buscar($id);
            $respmusical =  $pruebamusical->Buscar($id);
            if ($respcine == true) {
                $costoCine +=   $this->suma($pruebacine, $preciolaFuncion);
            } elseif ($respteatro == true) {
                $costoTeatro += $this->suma($pruebateatro, $preciolaFuncion);
            } elseif ($respmusical == true) {

                $costoMusical += $this->suma($pruebamusical, $preciolaFuncion);
            }
        }
        $costoTotal =    $costoCine + $costoMusical + $costoTeatro;
        $cadena =  "\nCostos de las funciones: ";
        $cadena .= "\n\tObras de teatro: $" . $costoTeatro;
        $cadena .= "\n\tObra de Cine: $" . $costoCine;
        $cadena .= "\n\tObras Musicales: $" . $costoMusical;
        $cadena .= "\n\tCosto total: $" . $costoTotal;

        return $cadena;
    }

    function suma($tipoObra, $preciolaFuncion)
    {
        if (is_a($tipoObra, 'obrateatro')) {
            $costo = $preciolaFuncion  * (45 / 100);
        } elseif (is_a($tipoObra, 'obracine')) {
            $costo = $preciolaFuncion * (12 / 100);
        } elseif (is_a($tipoObra, 'obramusical')) {
            $costo = $preciolaFuncion * (65 / 100);
        }
        return $costo;
    }

    //metodo que se seleccione la opcion del cual desea visualizar el costo
    public function sumaFuncion($pruebateatro)
    {
        $costo = 0;
        $respuestaArreglo = $pruebateatro->listar();
        foreach ($respuestaArreglo as $objFuncion) {
            $preciolaFuncion = $objFuncion->getPrecio();
            $costo += $this->suma($pruebateatro, $preciolaFuncion);
        }
        return $costo;
    }

    //**metodo que corrobora si el horario ingresado se cumple dentro de los parametros requeridos y se retorna tipo string*/
    public function corroborarHorario()
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
                    $horario = $horas . ":" . $minutos;
                    //$horario = ["hs" => $horas, "min" => $minutos];
                } else {
                    echo "los minutos no son validos \n";
                }
            } else {
                echo "horas no es valida \n";
            }
        } while ($bandera);
        return $horario;
    }


    //**metodo que recibe el tipo de objeto (teatro, cine, musical) y lo filtramos para efectuar la eliminacion */

    public function borrarFunciones($objObra)
    {
        $respuesta = "";

        if (is_a($objObra, 'obrateatro')) {
            $respuesta =  $this->metodoBorrar($objObra);
        } elseif (is_a($objObra, 'obracine')) {
            $respuesta =   $this->metodoBorrar($objObra);
        } elseif (is_a($objObra, 'obramusical')) {

            $respuesta =  $this->metodoBorrar($objObra);
        }

        return $respuesta;
    }

    //**Este metodo recibe por parametro el obj a eliminar  */
    public function metodoBorrar($objObra)
    {
        $arrayCarga = [];
        $cargaObjeto = [];
        $mensaje = "";
        // $this->setarregloFunciones($objObra->listar());
        $this->setarregloFunciones($arrayCarga = []);
        $arrayCarga = $this->getarregloFunciones();

        echo "\tDesea borrar todas las funciones o solo uno, \n\t\t\t>>> seleccione opcion: (1: TODOS - 2: SOLO UNO)\n";
        $tipoSeleccion = trim(fgets(STDIN));
        if ($arrayCarga == NULL) {
            echo ">>> No hay registros para borrar \n";
        } else {

            if ($tipoSeleccion == 1) {

                if (count($arrayCarga) > 0) {
                    foreach ($arrayCarga as $key => $funciones) {

                        if (get_class($funciones)  == get_class($objObra)) {

                            array_push($cargaObjeto, $funciones);
                        }
                    }
                }
                if (count($cargaObjeto) == 0) {
                    $mensaje =  "\e[41mNO HAY REGISTRO CARGADOS DE \e[0m " .  get_class($funciones) . "\n";
                } else {
                    foreach ($cargaObjeto as $ids => $data) {
                        $id = $data->getidFuncion();
                        $respuesta = $objObra->Buscar($id);

                        if ($respuesta == true) {
                            $objObra->eliminar();
                            unset($cargaObjeto[$ids]);
                        }

                        if (count($cargaObjeto) == 0) {
                            $mensaje =  "\e[41mSE ELIMINO CORRECTAMENTE TODAS LAS FUNCIONES \e[0m\n";
                            $this->setarregloFunciones($array = []);
                        }
                    }
                }
            } else {

                $colrespuesta = $objObra->listar();
                if (count($colrespuesta) > 0) {

                    foreach ($colrespuesta as $unaTeatro) {
                        echo $unaTeatro;
                        echo "\n-------------------------------------------------------\n";
                    }

                    //  $this->setarregloFunciones($colrespuesta);

                    echo "Ingrese el id de la funcion que desea borrar: ";
                    $idborrar = trim(fgets(STDIN));

                    $respuesta = $objObra->Buscar($idborrar);
                    $respuesta = $objObra->eliminar();

                    if ($respuesta == true) {
                        $mensaje = "\e[41mSE ELIMINO CORRECTAMENTE \e[0m\n";
                    }
                } else {
                    $mensaje = "\e[41mNO HAY REGISTROS CARGADOS \e[0m\n";
                    $this->setarregloFunciones($array = []);
                }
            }
        }

        return $mensaje;
    } //fin funcion metodoBorrar
}
