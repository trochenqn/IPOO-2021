<?php

class tienda
{

    private $colProductosImportado;
    private $colProductoRegional;
    private $colVentas;
    private $colCliente;


    public function __construct($micolProductosImportado, $micolProductoRegional, $micolVentas, $micolCliente)
    {
        $this->colProductosImportado = $micolProductosImportado;
        $this->colProductoRegional = $micolProductoRegional;
        $this->colVentas = $micolVentas;
        $this->colCliente = $micolCliente;
    }
    //get y set colProductosImportado

    public function getcolProductosImportado()
    {
        return $this->colProductosImportado;
    }

    public function setcolProductosImportado($micolProductosImportado)
    {
        $this->colProductosImportado   = $micolProductosImportado;
    }
    //get y set colProductoRegional
    public function getcolProductoRegional()
    {
        return $this->colProductoRegional;
    }

    public function setcolProductoRegional($micolProductoRegional)
    {
        $this->colProductoRegional   = $micolProductoRegional;
    }
    //get y set colVentas
    public function getcolVentas()
    {
        return $this->colVentas;
    }

    public function setcolVentas($micolVentas)
    {
        $this->colVentas   = $micolVentas;
    }
    //get y set colCliente
    public function getcolCliente()
    {
        return $this->colCliente;
    }

    public function setcolCliente($micolCliente)
    {
        $this->colCliente   = $micolCliente;
    }

    public function __toString()
    {
        $cadena = "Productos Importados: " . $this->recorrer($this->getcolProductosImportado());
        $cadena .= "Productos Regionales: " . $this->recorrer($this->getcolProductoRegional());
        $cadena .= "coleccion de venta: " . $this->recorrer($this->getcolVentas());
        $cadena .= "Cliente: " . $this->recorrer($this->getcolCliente());


        return $cadena;
    }


    public function recorrer($valor)
    {
        $retornar = "";
        foreach ($valor as $key) {
            $retornar = $key . "\n";
            $retornar .= "-----------------\n";
        }
        return $retornar;
    }


    //metodos
    public function incorporarProductoTienda($objProducto)
    {
        $array_colproductosRegionales = $this->getcolProductoRegional();
        $array_colproductosImportadas = $this->getcolProductosImportado();
        $codigoBarra =  $objProducto->getcodigoBarra();
        $result = false;
        if (is_a($objProducto, 'productoRegionales')) {

          
            foreach ($array_colproductosRegionales as $data) {
                $codigo = $data->getcodigoBarra();
                if ($codigo <>  $codigoBarra) {
                    array_push($array_colproductosRegionales, $objProducto);
                    $this->setcolProductoRegional($array_colproductosRegionales);
                    $result = true;
                }
            }
        } else {
         
            foreach ($array_colproductosImportadas as $data) {
                $codigo = $data->getcodigoBarra();
                if ($codigo <>  $codigoBarra) {
                    array_push($array_colproductosImportadas, $objProducto);
                    $this->setcolProductosImportado($array_colproductosRegionales);
                    $result = true;
                }
            }
        }

        return $result;
    }


    public function retornarImporteProducto($codProducto)
    {
        $array_colproductosRegionales = $this->getcolProductoRegional();
        $array_colproductosImportadas = $this->getcolProductosImportado();

        $precioVenta = 0;


        if ($precioVenta == 0) {
            foreach ($array_colproductosRegionales as $data) {

                $codigo = $data->getcodigoBarra();

                if ($codigo == $codProducto) {
                    $precioVenta =  $data->darPrecioVenta();
                }
            }
        }

        if ($precioVenta == 0) {
            foreach ($array_colproductosImportadas as $data) {

                $codigo = $data->getcodigoBarra();

                if ($codigo == $codProducto) {
                    $precioVenta =  $data->darPrecioVenta();
                }
            }
        }

        return $precioVenta;
    }



    public function retornarCostoProductoTienda()
    {
        $array_colproductosRegionales = $this->getcolProductoRegional();
        $array_colproductosImportadas = $this->getcolProductosImportado();

        $sumaProductos = 0;
        $sumaregionales = 0;
        $sumaImportados = 0;

        foreach ($array_colproductosRegionales as $data) {
            $sumaregionales = $data->darPrecioVenta();
        }

        foreach ($array_colproductosImportadas as $data) {
            $sumaImportados = $data->darPrecioVenta();
        }
        $sumaProductos = $sumaregionales + $sumaImportados;

        return $sumaProductos;
    }

    public function productoMasEconomico()
    {
        $array_colproductosRegionales = $this->getcolProductoRegional();
        $array_colproductosImportadas = $this->getcolProductosImportado();
        $productoMasBarato = "";

        list($productoMasBaratoRegionales, $minPrecioProductoRegionales) = $this->recorrerPrecioMin($array_colproductosRegionales);
        list($productoMasBaratoImportados, $minPrecioProductoImportados) = $this->recorrerPrecioMin($array_colproductosImportadas);

        if ($minPrecioProductoRegionales >  $minPrecioProductoImportados) {
            $productoMasBarato = $productoMasBaratoImportados;
        } else {
            $productoMasBarato = $productoMasBaratoRegionales;
        }


        return $productoMasBarato;
    }


    public function recorrerPrecioMin($coldata)
    {
        $productoMasBarato = "";
        $minProducto = 0;
        $respuesColeccion = array();

        foreach ($coldata as $data) {
            if ($data->darPrecioVenta() < $minProducto) {
                $minProducto = $data->darPrecioVenta();

                $productoMasBarato = $data->getrefRubro()->getdescripcion();
            } else {
                if ($minProducto < $data->darPrecioVenta()) {
                    $minProducto = $data->darPrecioVenta();
                    $productoMasBarato = $data->getrefRubro()->getdescripcion();
                }
            }
        }
        $respuesColeccion = [$productoMasBarato, $minProducto];

        return $respuesColeccion;
    }


    public function informarProductosMasVendidos($anio, $n)
    {

        $arrayVentaFecha = array();

        $ColVentas = $this->getColVentas();
        foreach ($ColVentas  as $key) {
            $añoVenta = $key->getfechaVenta();
            //ver la fecha como lo recibo=?
            if ($añoVenta == $anio) {
                array_push($arrayVentaFecha, $key->getcolRefProducto());
            }
        }

        /* foreach ($arrayVentaFecha as $data) {
            $dataRubro = $data->getrefRubro();
            foreach ($dataRubro as $key) {
               
                $descripcion = $key->getdescripcion();
                if ($i<$n){
                    $array_listaMasVendida[$i]=$descripcion;
                    $j=$i;
                    $i++;
                }
                if ( $array_listaMasVendida[$j]<>$descripcion){

                }

            }
        }*/
        return $arrayVentaFecha;
    }

    //metodo que retorna el promedio de ventas de productos importados realizados

    public function promedioVentasImportados()
    {
        $colVentas = $this->getcolVentas()->getcolRefProducto();
        $contador = 0;
        if (is_a($colVentas, 'productoImportados')) {

            for ($i = 0; $i < count($colVentas); $i++) {
                $ti = $colVentas[$i]->darPrecioVenta();
                $contador = $contador + $ti;
            }
            $sumaTotal = $contador * (count($colVentas));
        }

        return $sumaTotal;
    }
    //metodo que retorna todo los productos que fueron comprados por la persona indetificada con el tipoDoc
    // y numDoc recibidos por parametros.
    public function informarConsumoCliente($tipoDoc, $numDoc)
    {
        $arrayProductos = array();

        $colCliente = $this->getcolVentas();
        for ($i = 0; $i < count($colCliente); $i++) {
            $tipoCliente = $colCliente[$i]->getobjCliente();
            $ventas = $colCliente[$i]->getcolRefProducto();
            if ($tipoCliente->getTipoDoc() == $tipoDoc && $tipoCliente->getdni() == $numDoc) {
                array_push($arrayProductos,  $ventas);
            }
        }

        return $arrayProductos;
    }


    /*
    $dt = getdate(date("U"));
    $this->setFechaOrtorgamiento('$dt[month] $dt[mday], $dt[year]');
    $date->format('Y-m-d')*/
}
