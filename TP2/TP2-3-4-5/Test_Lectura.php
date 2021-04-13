<?php

include_once 'Lectura.php';
include_once 'Libro.php';
include_once 'Persona.php';

function menuLectura()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo ">>>>>>>>>>>>>>>>>>>>--MENU-----<<<<<<<<<<<<<<<<<<<<<\n";
    echo "1) Selecciona un libro a leer. \n";
    echo "2) cargar libro-pagina actual. \n";
    echo "3) Siguiente pagina. \n";
    echo "4) retroceder una pagina. \n";
    echo "5) ir a la pagina. \n";
    echo "6) Buscar se se encuentra leido un libro. \n";
    echo "7) Buscar la sipnosis del libro. \n";
    echo "8) Listado de libro leido por año. \n";
    echo "9) Listado de libro leido por autor. \n";
    echo "0) Salir. \n";
    echo ">>>>>>>>>>>>>>>>>>>>>----------<<<<<<<<<<<<<<<<<<<\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

function lecturaLibro(){

    $arrayLibros = biblioteca();
    $paginaActual = 1; 
    $paginaTotalLibro = $arrayLibros->getCantidadpagina();
    //array libros leidos    
    $arrayLibrosLeidos= array();
    $arrayLibrosLeidos[]= array($arrayLibros->getTitulo(), $arrayLibros->getApellidoAutor(), $arrayLibros->getAnoEdicion(), $arrayLibros->getSinopsisLibro() );
   
    $lectura = new Lectura($arrayLibros,$paginaActual,$arrayLibrosLeidos);
    
do {
    $opcion = menuLectura();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1: // seleccionar libro
            $arrayLibros = biblioteca();
            $arrayLibrosLeidos[]=array($arrayLibros->getTitulo(), $arrayLibros->getApellidoAutor(), $arrayLibros->getAnoEdicion(), $arrayLibros->getSinopsisLibro()); 
            $paginaActual = 1; 
            $paginaTotalLibro = $arrayLibros->getCantidadpagina();
            $lectura = new Lectura($arrayLibros,$paginaActual, $arrayLibrosLeidos);
            break;
        case 2://cargar libro-pagina actual
            $paginaActual = $lectura->getPaginaActual();
            echo "El libro un total de ".$paginaTotalLibro . " paginas, se encuentra en la pagina Nro ".$paginaActual."\n";
            break;
        case 3://Siguiente pagina
           $paginaActual = $lectura->siguientePagina();
           echo "La siguiete pagina es ".$paginaActual."\n";
            break;
        case 4://retroceder una pagina.
            $paginaActual = $lectura->retrocederPagina();
            echo "Se retrocedio a la pagina  ".$paginaActual."\n";
         //  echo  $TestLibro->iguales($TestLibro, libros()). "\n"; 
            break;
        case 5: // ir a la pagina
            echo "Seleccione la pagina que quiere ir de ". $paginaTotalLibro."\n";
            $x = trim(fgets(STDIN));
            if ($x <=  $paginaTotalLibro && $x >0 ){
               $lectura->irPagina($x);
                $paginaActual = $lectura->getPaginaActual();
               echo "Se encuentra en la pagina ".$paginaActual . " de un total de ".$paginaTotalLibro."\n" ;
             }
            break;
        case 6: // Buscar se se encuentra leido un libro
            echo "Ingrese el titulo del libro a chequear\n";
            $titulo = trim(fgets(STDIN));
          $respuesta =  $lectura->libroLeido($titulo);
            if ($respuesta){
                echo "░▓░*El libro se encuentra leido\n";
            }else{
                echo "░▓░*El libro no se encuentra leido\n";
            }
           break;
        case 7: // Buscar la sipnosis del libr
            echo "Ingrese el titulo del libro para buscar su sipnosis\n";
            $titulo = trim(fgets(STDIN));
          $respuesta2 =  $lectura->darSinopsis($titulo);
            if (!$respuesta2){
                echo "░siptonis del libro".$titulo." : ".$respuesta2." ░\n";
            }else{
                echo $respuesta2."\n";
            }
           break;
        case 8: // Listado de libro leido por año
            echo "Ingrese el año del libro a buscar\n";
            $anoEdicion = trim(fgets(STDIN));
            $respuesta1 =  $lectura->leidosAnioEdicion($anoEdicion);
            if ($respuesta1){
                
                for ($i=0; $i<count($respuesta1); $i++){
                    for ($j=0; $j<count($respuesta1[$i]); $j++){
                     echo "El libros leido es: ".$respuesta1[$i][0].", año de edicion:  ".$respuesta1[$i][1]."\n";
                     }
                 }
                
                           
            }else{
                echo  "▓ No hay libros leidos en ese año ▓\n";
            }
           break;
        case 9: // Listado de libro leido por autor
            echo "Ingrese el nombre del autor del libro a buscar\n";
            $autorLibro = trim(fgets(STDIN));
            $respuesta3 =  $lectura->darLibrosPorAutor($autorLibro);
            if ($respuesta3){
                for ($i=0; $i<count($respuesta3); $i++){
                      for ($j=0; $j<count($respuesta3[$i]); $j++){
                       echo "El nombre del libros es: ".$respuesta3[$i][0].", del autor:  ".$respuesta3[$i][1]."\n";
                       }
                   }

             }else{
                           
                echo "░  No hay libros leidos ░\n";
            }
           break;
    }
  } while ($opcion != 0);
}

function biblioteca()//funcion libro para cargar la lista de arrayLibros
{

$person1 = new Persona("Christian Andersen", "Hans", "DNI", "0000111");
$person2 = new Persona("Austen", "Jane", "DNI", "2514632");
$person3 = new Persona("William", "Faulkner", "DNI", "458786");


$libro1 = new Libro("123456", "Cuentos infantiles", "1835", "argenta", $person1, "150", "Hijo de un humilde zapatero, pronto aprendió diversos oficios, pero no finalizó ninguno. Con catorce años, 
                         huyó con poco dinero a Copenhague dispuesto a hacer fortuna como actor y cantante; malvivió, escribió algunas obras y después de privaciones y desengaños, consiguió 
                         despertar el interés de personalidades del país que se ocuparon de su formación. Andersen siempre sintió que su origen humilde era un lastre y fantaseaba que era el hijo
                         ilegítimo de un gran señor.");
$libro2 = new Libro("225545", "Orgullo y prejuicio", "1813", "planetas libros", $person2, "80", "Orgullo y prejuicio (en inglés, Pride and Prejudice), publicada por primera vez el 28 de enero de 1813 como una obra anónima, es la 
                          más famosa de las novelas de Jane Austen y una de las primeras comedias románticas en la historia de la novela");
$libro3 = new Libro("35856", "El ruido y la furia", "1929", "limonero", $person3, "200", "El ruido y la furia (el original en inglés: The Sound and the Fury) es la cuarta novela del autor estadounidense William Faulkner, publicada en 1929");

$arrayLibros = array(
 $libro1, $libro2, $libro3
);

do{
    echo ">>>>>>>--LIBRERIA-----<<<<<<<<<<<\n";
    echo "Elige un libro \n";
    $i=0;
    foreach($arrayLibros as $item){
        $i++;
        $datoitem= $i.": ".$item->getTitulo()."\n";
        echo $datoitem;
    }
    $nro = trim(fgets(STDIN));
    if ($nro <= 3 && $nro >0){
        switch($nro){
            case 1:
                $TestLibro = $libro1;
                break;
            case 2:
                $TestLibro = $libro2;
                break;
            case 3:
                $TestLibro = $libro3;
                break;
        }
    }

}while($nro >3 && $nro<=0);

return $TestLibro;
}

lecturaLibro();

?>