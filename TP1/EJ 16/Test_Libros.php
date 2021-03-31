<?php
include 'Libro.php';

$LibrosEditor =
           array(
            array ( "Editorial"=>"martin", "libro" => "El Código da Vinci"),
            array( "Editorial"=>"pablo","libro"=> "Lo que el viento se llev"),
            array( "Editorial"=>"juan", "libro"=> "Harry Potter"),
            array( "Editorial"=>"carlos", "libro"=> "El Señor de los Anillos"),
            array("Editorial"=>"carlos", "libro"=> "El Alquimistas",),

           );

function menu()
{
    /**
     * Menu que se muestra al usuario
     * Se controla la opcion ingresada desde el programa principal en el switch correspondiete
     */
    echo "--------------------------------------------------------------\n";
    echo "1) El libro pertenece a la Editorial. \n";
    echo "2) Coleccion de Libros. \n";
    echo "3) Años de edicion del libro. \n";
    echo "4) Buscar libro por editorial. \n";
    echo "0) Salir. \n";
    echo "--------------------------------------------------------------\n";

    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

$nuevoLibro = new Libro("El mediocre", 2000, "macana", "martin pereyra");


do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Exit! \n";
            break;
        case 1:
            echo $nuevoLibro->perteneceEditorial("papa"). "\n";
            break;
        case 2:
           echo  $nuevoLibro->iguales("Lo que el viento se llev",$LibrosEditor). "\n"; 
            break;
        case 3:
            echo $nuevoLibro->aniosdesdeEdicion(). "\n";
            break;
        case 4:
            $arrayLibros= $nuevoLibro->librodeEditoriales($LibrosEditor, "carlos");
            print_r($arrayLibros)."\n";
            break;
    }
} while ($opcion != 0);

echo $nuevoLibro;

?>