<?php

class Producto
{
    private $codigoBarra;
    private $descripcion;
    private $stock;
    private $porcentajeIVA;
    private $precioCompra;
    private $refRubro;
    //private $origenProducto;
    //private $origenProductos = array("regional", "importado");

    public function __construct($micodigoBarra, $midescripcion, $mistock, $miporcentajeIVA, $miprecioCompra, $mirefRubro)
    {
        $this->codigoBarra = $micodigoBarra;
        $this->descripcion = $midescripcion;
        $this->stock = $mistock;
        $this->porcentajeIVA = $miporcentajeIVA;
        $this->precioCompra = $miprecioCompra;
        $this->refRubro = $mirefRubro;
    }

    public function getcodigoBarra()
    {
        return $this->codigoBarra;
    }

    public function setcodigoBarra($micodigoBarra)
    {
        $this->codigoBarra = $micodigoBarra;
    }
    public function getdescripcion()
    {
        return $this->descripcion;
    }

    public function setdescripcion($midescripcion)
    {
        $this->descripcion = $midescripcion;
    }

    public function getstock()
    {
        return $this->stock;
    }

    public function setstock($mistock)
    {
        $this->stock = $mistock;
    }

    public function getporcentajeIVA()
    {
        return $this->porcentajeIVA;
    }

    public function setporcentajeIVA($miporcentajeIVA)
    {
        $this->porcentajeIVA = $miporcentajeIVA;
    }

    public function getprecioCompra()
    {
        return $this->precioCompra;
    }

    public function setprecioCompra($miprecioCompra)
    {
        $this->precioCompra = $miprecioCompra;
    }

    public function getrefRubro()
    {
        $this->refRubro;
    }

    /* public function getOrigenProducto()
        {
           return $this->origenProducto;
        }*/

    public function __toString()
    {
        $cadena = "Codigo del Producto: " . $this->getcodigoBarra() . "\n";
        $cadena .= "descripcion del producto: " . $this->getdescripcion() . "\n";
        $cadena .= "stock del producto: " . $this->getstock() . "\n";
        $cadena .= "porcentaje IVA: " . $this->getporcentajeIVA() . "\n";
        $cadena .= "precio del producto: " . $this->getprecioCompra() . "\n";
        $data = $this->getrefRubro();
        $cadena .= "referencia del producto: " . $this->recorrer($data) . "\n";

        return $cadena;
    }

    public function recorrer($valor)
    {
        $retornar = "";
        foreach ($valor as $key) {
            $retornar .= $key . "\n";
            $retornar .= "-----------------\n";
        }
        return $retornar;
    }



    public function darPrecioVenta()
    {
     
        // $precioFinal = 0;
        // $ref = $this->getrefRubro();
        //ver el $this de ref....
        $precioRefencia = $this->getprecioCompra() + $this->getporcentajeIVA(); //+$this->getrefRubro()->getporcentajeGanancia();
        //array_search — Busca un valor determinado en un array y devuelve la primera clave correspondiente en caso de éxito
        //  (array_search($this->getOrigenProducto(),$this->origenProductos) !== false)  ?  $precioFinal= $this->porcentajeImportado( $precioRefencia): $precioFinal= $this->porcentajeRegional( $precioRefencia) ;

        return  $precioRefencia;
    }

    public function Print()
    {
        print_r($this->getrefRubro());
    }
}
