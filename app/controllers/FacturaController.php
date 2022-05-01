<?php

namespace App\controllers;

use App\models\FacturaModelo;

class FacturaController
{

    public static function showDetails(){
        $facturaModelo =  new FacturaModelo();
        $detalles = $facturaModelo->showDetails();
        require_once './app/views/factura/facturarViews.php';
    }

    public static function searchClient($cedula)
    {
        $facturaModelo =  new FacturaModelo();
        $facturaModelo->setCedula($cedula);
        $facturaCliente = $facturaModelo->searchClient();
        echo json_encode($facturaCliente);
    }

    public static function searchProduct($descripcion)
    {
        $facturaModelo = new FacturaModelo();
        $facturaModelo->setDescripcion($descripcion);
        $facturaProducto = $facturaModelo->serachProduct();
        echo json_encode($facturaProducto);
    }

    public static function insertDetail($id, $cantidad, $precio, $precio_total)
    {
        $facturaModelo = new FacturaModelo();
        $facturaModelo->setIdProducto($id);
        $facturaModelo->setCantidad($cantidad);
        $facturaModelo->setPrecio($precio);
        $facturaModelo->setPrecioTotal($precio_total);
        $detalle = $facturaModelo->insertDetail();
        echo json_encode($detalle);
    }
}
