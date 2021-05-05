<?php

class venta
{
    private $fechaVenta;
    private $colRefProducto;
    private $objCliente;

    public function __construct($mifechaVenta, $micolRefProducto, $miobjCliente)
    {
        $this->fechaVenta = $mifechaVenta;
        $this->colRefProducto = $micolRefProducto;
        $this->objCliente = $miobjCliente;
    }

    public function getfechaVenta()
    {
        return $this->fechaVenta;
    }

    public function setfechaVenta($mifechaVenta)
    {
        $this->fechaVenta   = $mifechaVenta;
    }

    public function getcolRefProducto()
    {
        return $this->colRefProducto;
    }

    public function setcolRefProducto($micolRefProducto)
    {
        $this->colRefProducto   = $micolRefProducto;
    }


    public function getobjCliente()
    {
        return $this->objCliente;
    }

    public function setobjCliente($miobjCliente)
    {
        $this->objCliente   = $miobjCliente;
    }

    public function __toString()
    {

        $cadena =  "fecha de la venta:  " . $this->getfechaVenta();
        $cadena .=  "Referencia Producto:  " .  $this->recorrer($this->getcolRefProducto());
        $cadena =  "Cliente:  " . $this->recorrer($this->getobjCliente());

        return $cadena;
    }


    public function recorrer($producto)
    {
        $retornar = "";
        foreach ($producto as $key) {
            $retornar .= "\n" . $key . "\n";
            $retornar .= "---------------------------\n";
        }
        return    $retornar;
    }


    public function darImporteVenta()
    {
        $array_coleccionProducto = $this->getcolRefProducto();
        $sumaTotal = 0;
        $suma = 0;
        if (count($array_coleccionProducto) >= 1) {
            for ($i = 0; $i < count($array_coleccionProducto); $i++) {
                if ($array_coleccionProducto[$i]->getstock() > 0) {
                    $suma =  $array_coleccionProducto[$i]->darPrecioVenta();
                }
            }

            $sumaTotal = $sumaTotal + $suma;
        }

        return $sumaTotal;
    }
}
