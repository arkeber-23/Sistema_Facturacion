<?php
namespace App\controllers;

use App\models\FacturaModelo;

class FacturaController{

    public static function searchClient($cedula){
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

}


?>