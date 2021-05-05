<?php

include_once 'producto.php';


class productoImportados extends Producto
{

    public function __construct($micodigoBarra, $midescripcion, $mistock, $miporcentajeIVA, $miprecioCompra, $mirefRubro)
    {
        parent::__construct($micodigoBarra, $midescripcion, $mistock, $miporcentajeIVA, $miprecioCompra, $mirefRubro);
    }

    public function __toString()
    {
        $cadena = "Porcentaje de descuento: " . parent::__toString() . "\n";

        return $cadena;
    }


    public function darPrecioVenta()
    {
        $precioVenta = parent::darPrecioVenta();
        $resultadoInteres = $precioVenta * (50 / 100);
        $resultadoImpuesto = $resultadoInteres * (10 / 100);
        $precioFinal = $precioVenta  + $resultadoImpuesto + $resultadoInteres;

        return  $precioFinal;
    }


}
