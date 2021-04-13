<?php
include 'Libro.php';
include_once 'Persona.php';


function biblioteca()//funcion libro para cargar la lista de arrayLibros
{

    
$person1 = new Persona("Christian Andersen", "Hans", "DNI", "0000111");
$person2 = new Persona("Austen", "Jane", "DNI", "2514632");
$person3 = new Persona("William", "Faulkner", "DNI", "458786");


$libro1 = new Libro("123456", "Cuentos infantiles", 1835, "argenta", $person1, 150, "Hijo de un humilde zapatero, pronto aprendió diversos oficios, pero no finalizó ninguno. Con catorce años, 
                         huyó con poco dinero a Copenhague dispuesto a hacer fortuna como actor y cantante; malvivió, escribió algunas obras y después de privaciones y desengaños, consiguió 
                         despertar el interés de personalidades del país que se ocuparon de su formación. Andersen siempre sintió que su origen humilde era un lastre y fantaseaba que era el hijo
                         ilegítimo de un gran señor.");
$libro2 = new Libro("225545", "Orgullo y prejuicio", 1813, "planetas libros", $person2, 80, "Orgullo y prejuicio (en inglés, Pride and Prejudice), publicada por primera vez el 28 de enero de 1813 como una obra anónima, es la 
                          más famosa de las novelas de Jane Austen y una de las primeras comedias románticas en la historia de la novela");
$libro3 = new Libro("35856", "El ruido y la furia", 1929, "limonero", $person3, 200, "El ruido y la furia (el original en inglés: The Sound and the Fury) es la cuarta novela del autor estadounidense William Faulkner, publicada en 1929");


return $arrayLibros = array(
 $libro1, $libro2, $libro3
);

}

function MenuLibro()
{
    do{
        echo "Elige un libro \n";
        $i=0;
        foreach(biblioteca() as $item){
            $i++;
            $datoitem= $i.": ".$item->getTitulo()."\n";
            echo $datoitem;
        }
        $nro = trim(fgets(STDIN));
        if ($nro <= 3 && $nro >0){
            switch($nro){
                case 1:
                    $TestLibro = biblioteca()[0];
                    break;
                case 2:
                    $TestLibro = biblioteca()[1];
                    break;
                case 3:
                    $TestLibro = biblioteca()[2];
                    break;
            }
        }

    }while($nro >3 && $nro<=0);

    return $nro-1;
}



function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "--------------------------------------------------------------\n";
    echo "1) Elegir el libro. \n";
    echo "2) El libro pertenece a la Editorial. \n";
    echo "3) Coleccion de Libros. \n";
    echo "4) Años de edicion del libro. \n";
    echo "5) Buscar libro por editorial. \n";
    echo "0) Salir. \n";
    echo "--------------------------------------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

 function mainLibros()
{
    $TestLibro = biblioteca()[0];
$testEditorial = biblioteca()[2]->getEditorial();
   
do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1://Elegir el libro
            menuLibro();
            break;
        case 2://El libro pertenece a la Editorial
            echo "Elegir una editorial\n";
            $j=0;
            foreach( biblioteca() as $item){
                $j++;
                $dato= $j.": ".$item->getEditorial()."\n";
                echo $dato;
            }
            $nro = trim(fgets(STDIN));
            do{
                if ($nro <= 3 && $nro >0){
                    switch($nro){
                        case 1:
                            $testEditorial = biblioteca()[0]->getEditorial();
                            break;
                        case 2:
                            $testEditorial = biblioteca()[1]->getEditorial();
                            break;
                        case 3:
                            $testEditorial = biblioteca()[2]->getEditorial();
                            break;
                    }
                }
            }while($nro >3 && $nro<=0);
            $respuesta=  $TestLibro->perteneceEditorial($testEditorial);
            if ($respuesta == true){
                echo "El libro ".$testEditorial." pertenece a la Editorial\n";
            }else{
                echo "El libro no pertenence a la Editorial\n";
            }
            break;
        case 3://Coleccion de Libros.
           echo  $TestLibro->iguales($TestLibro, biblioteca()). "\n"; 
            break;
        case 4: //Años de edicion del libro
            echo $TestLibro->aniosdesdeEdicion(). "\n";
            break;
        case 5://Buscar libro por editorial
            $cargaLibros= $TestLibro->librodeEditoriales( biblioteca(), $testEditorial);
            echo "Libros publicado por la Editorial: ".$testEditorial."\n";
            foreach($cargaLibros as $libro){
                echo "1: ". $libro. "\n";
            }
            break;
    }
} while ($opcion != 0);
}

mainLibros();


?>