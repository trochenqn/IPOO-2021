<?php
include 'Teatro.php';

function menu()
{
     /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "***********************************\n";
    echo "1) Cambiar Nombre de Teatro y Direccion. \n";
    echo "2) Cargar Funcion del dia. \n";
    echo "3) Modificar Funcion del dia. \n";
    echo "4) visualizar funciones. \n";
    echo "5) Borrar Funciones. \n";
    echo "0) Salir. \n";
    echo "***********************************\n";

    // Ingreso la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}


$nuevoTeatro = new Teatro("El Nacional", "Avenida Corrientes, Buenos Aires", "Altri Canti", 1250);

do{
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1:
           echo $nuevoTeatro->cambiarNombreTeatro_direccion("Gran Rex", " Avenida Corrientes (nº 857) - BS.AS"). "\n";
            break;
        case 2:
            $i=0;
            while ($i <=3){
                echo " (*) Ingrese el nombre de la Funcion----\n";
                $nombreFuncion = trim(fgets(STDIN));
                echo " (*) Ingrese el precio de la Funcion----\n";
                $precioFuncion = (int)trim(fgets(STDIN));
                echo $nuevoTeatro->cargarFuncion($nombreFuncion,$precioFuncion)."\n";
                $i++;
            }
            break;
        case 3:
            echo "Desea modificar una funcion (A) o todos (B): \n";
            $modificacion = strtoupper(trim(fgets(STDIN)));
            echo $modificacion;
            if ($modificacion==="A"){
                echo " (*) Ingrese el turno a modificar -0, 1, 2 o 3- \n"; 
                $turno = (int) trim(fgets(STDIN));
                $nuevoTeatro->modificarFuncion_precio($modificacion, $turno,"Theodora 2", 2500)."\n";
                
            }else{
                $i=0;
                while($i<=3){
                echo " (*) Ingrese el nombre de la funcion a modificar->". $i ." \n";
                $nombreFuncion = trim(fgets(STDIN));
                echo " (*) Ingrese el precio de la Funcion a modificar->". $i ." \n";
                $precioFuncion = trim(fgets(STDIN));
                $nuevoTeatro->modificarFuncion_precio($modificacion, $i,$nombreFuncion, $precioFuncion ) ."\n";
                $i++;
                }
            }
            break;
        case 4:
            echo $nuevoTeatro; 
            break;
        case 5:
            echo $nuevoTeatro->borrarFunciones()."\n"; 
            break;
    }
} while ($opcion != 0);

?>