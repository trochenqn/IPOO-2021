
<?php
/*Realizar el diseño y la correspondiente implementación en PHP de un script vinotecaNqn.php del siguiente enunciado:

Dado una estructura de arreglos asociativos, donde cada posición del arreglo se corresponde con una variedad de vino 
(malbec, cabernet Sauvignon, Merlot) y se almacena la siguiente información: variedad, cantidad de botellas, año de producción, precio por unidad:

Implementar una función que reciba un arreglo con las características  mencionadas y retorne  un arreglo que por variedad de vino guarde 
la cantidad total de botellas y el precio promedio.
Implementar una función main() que cree un arreglo con las características mencionadas, invoque a la función implementada en 1 y visualice 
su resultado Subir a su cuenta GitHub la resolución del Trabajo Practico de Repaso.
Fecha de entrega 19/03/2021*/

$vinoteca = array(
    "Malbec"=> 
            array (
             ["cantidad"=>50,"anoProduccion"=>1900, "precioUnidad"=>400,],
             ["cantidad"=>150,"anoProduccion"=>1800, "precioUnidad"=>30,]  
                        
            ),
    "Cabernet"=>
             array(
                ["cantidad"=>50,"anoProduccion"=>2021,"precioUnidad"=>50]
                
             ),
    "Merlot"=>
             array(
               [ "cantidad"=>30, "anoProduccion"=>2000,"precioUnidad"=>15],
               [ "cantidad"=>21, "anoProduccion"=>1975,"precioUnidad"=>50]
                
             ),
            );
//  print_r(  $vinoteca);
   
function arregloVinoteca($vinoteca){

    $datosVinoteca = array();
    $varidad="";
    $totalBotellas=0;
    $sumarValor=0;

    foreach($vinoteca as $valor =>$detalles) {

        $varidad= "$valor"; 
   
        foreach($detalles as $indice => $valor)
        {
           if ($varidad==='Malbec'){
                $totalBotellas= $totalBotellas + $detalles[$indice]["cantidad"];
               $sumarValor= $sumarValor + $detalles[$indice]["precioUnidad"];
            }  if ($varidad==='Cabernet'){
                $totalBotellas= $totalBotellas + $detalles[$indice]["cantidad"];
              $sumarValor= $sumarValor + $detalles[$indice]["precioUnidad"];
            }  if ($varidad==='Merlot'){
                $totalBotellas= $totalBotellas + $detalles[$indice]["cantidad"];
                $sumarValor= $sumarValor + $detalles[$indice]["precioUnidad"];
            }
        
        }

         $promedioPrecio = $sumarValor/$totalBotellas;  
          $sumarValor=0;
      
         $datosVinoteca[$varidad]["totalBotella"]= $totalBotellas;
         $datosVinoteca[$varidad]["promedioPrecio"]= $promedioPrecio;
           
         $datosVinoteca+=$datosVinoteca;
          $totalBotellas=0;
      
     
        }
      
    return   $datosVinoteca ;
  
}

function main($vinoteca){

  $datosVinotecaRecibido = arregloVinoteca($vinoteca);
  echo "---LISTA DE LA VINOTECA POR VARIEDAD---". "\n";
    print_r($datosVinotecaRecibido);
    echo "***FIN DEL PROGRAMA***" . "\n";
}

main($vinoteca);









    
   


