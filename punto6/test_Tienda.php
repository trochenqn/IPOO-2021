<?php

include 'cliente.php';
include 'productoImportados.php';
include 'productoRegionales.php';
include 'rubro.php';
include 'Tienda.php';
include 'venta.php';




$obRubro1 = new rubro( "converva", 35);
$obRubro2 = new rubro( "regalos", 55);
$colRubro = [$obRubro1,$obRubro2 ];

$objProducto1 = new productoImportados(122223, "juguete", 5, 10, 150, $obRubro2);
$objProducto2 = new productoImportados(122224, "juguete", 2, 15, 300, $obRubro1);
$colProductoImportados = [$objProducto1, $objProducto2];
$objProducto3 = new productoRegionales(2333331, "verduras", 15, 0.5, 15, $obRubro1, 5);
$objProducto4 = new productoRegionales(2333332, "verduras", 10, 6, 15, $obRubro2, 5);
$colProductosRegionales = [$objProducto3,$objProducto4  ];

$colProductos= [$objProducto1, $objProducto2, $objProducto3, $objProducto4];

echo $objProducto1->darPrecioVenta()."\n";
echo $objProducto1->Print()."\n";

echo $objProducto2->darPrecioVenta()."\n";

echo $objProducto3->darPrecioVenta()."\n";

echo $objProducto4->darPrecioVenta()."\n";



$objCliente1 = new cliente("dni", 27492762,"jose luis", "perez");
$objCliente2 = new cliente("dni", 31489572,"david", "carrizo");
$objCliente3 = new cliente("dni", 45154872,"martin", "gonzalez");
$colCliente= [$objCliente1, $objCliente2, $objCliente3 ];


$colVentas = new venta("10-05-2021", $colProductoImportados,$objCliente1);


$objTienda1 = new tienda($colProductos,$colProductos,$colVentas ,$colCliente);

$objTienda2 = new tienda($colProductoImportados,$colProductosRegionales,$colVentas ,$colCliente);

//echo $objTienda1."\n";
echo $objTienda2."\n";

echo "Importe de venta\n";
echo $colVentas->darImporteVenta()."\n";

echo "Costo de Productos de la tienda\n";
//echo $objTienda1->retornarCostoProductoTienda()."\n";
echo $objTienda2->retornarCostoProductoTienda()."\n";


$objProducto5 = new productoRegionales(2333336, "verduras", 5, 6, 15, $obRubro1, 5);
$respuesta = $objTienda1->incorporarProductoTienda($objProducto5);
if ($respuesta==true){
    echo "El producto  se cargo con exito \n";
}else{
    Echo "El Producto no se cargo"."\n";
}



$objProducto1 = new productoImportados(122223, "juguete", 5, 10, 150, $obRubro2);
$respuesta = $objTienda1->incorporarProductoTienda($objProducto1);
if ($respuesta==true){
    echo "El producto  se cargo con exito \n";
}else{
    Echo "El Producto no se cargo"."\n";
}

echo $objTienda1->retornarImporteProducto(122223);
//producto mas barato 
echo $objTienda1->productoMasEconomico();
echo "promedio \n";
echo $objTienda1->promedioVentasImportados();
?>