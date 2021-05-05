<?php

include_once 'producto.php';

class productoRegionales extends Producto{

    private $porcetajeDescuento;

    public function __construct($micodigoBarra, $midescripcion, $mistock, $miporcentajeIVA, $miprecioCompra, $mirefRubro, $miporcetajeDescuento)
    {
       parent::__construct($micodigoBarra, $midescripcion, $mistock, $miporcentajeIVA, $miprecioCompra, $mirefRubro);
        $this->porcetajeDescuento= $miporcetajeDescuento;
    }

    public function getporcentajeDescuento()
    {
        return $this->porcetajeDescuento;
    }

    public function setporcentajeDescuento($miporcentajeDescuento)
    {
        $this->porcetajeDescuento = $miporcentajeDescuento;
    }

    public function __toString()
    {
        
        $cadena = "Porcentaje de descuento: ".$this->getporcentajeDescuento()."\n";
        $cadena  .= "Porcentaje de descuento: ".parent::__toString()."\n";

        return $cadena;
    }


    public function darPrecioVenta()
    {
      
       $precioProducto = parent::darPrecioVenta();
       $descuento = $precioProducto * ($this->getporcentajeDescuento() / 100);
       $precioFinal=  $precioProducto - $descuento;


        return  $precioFinal;
    }

  




}

?>