<?php

namespace App\controllers;

use App\models\ProductoModelo;

class ProductoController
{

    public static function all()
    {
        $producto = new ProductoModelo();
        $productos =  $producto->all();
        require_once './app/views/producto/productoViews.php';
    }

    public static function insert($descripcion, $stock, $precio)
    {
        $producto = new ProductoModelo();
        $producto->setDescripcion($descripcion);
        $producto->setStock($stock);
        $producto->setPrecio($precio);
        $insert =  $producto->insert();
        echo json_encode($insert);
    }
    public static function edit($id, $descripcion, $stock, $precio)
    {
        $producto = new ProductoModelo();
        $producto->setIdProducto($id);
        $producto->setDescripcion($descripcion);
        $producto->setStock($stock);
        $producto->setPrecio($precio);
        $update  = $producto->edit();
        echo json_encode($update);
    }
    public static function delete($id)
    {
        $producto = new ProductoModelo();
        $producto->setIdProducto($id);
        $eliminar = $producto->delete();
        echo json_encode($eliminar);
    }

    public static function search($texto)
    {
        $producto = new ProductoModelo();
        $producto->setBuscador($texto);
        $productos =  $producto->search();
        require_once './app/views/producto/productoViews.php';
    }

    public static function searchById($id)
    {
        $producto = new ProductoModelo();
        $producto->setBuscador($id);
        $data = $producto->searchById();
        extract($data);
        require_once './app/views/producto/editarProducto.php';
    }
}
