<?php

namespace App\models;

use App\config\Conexion;
use PDO;
use PDOException;

class FacturaModelo
{
    private $idProducto;
    private $cantidad;
    private $precio;
    private $pTotal;
    private $cedula;
    private $descripcion;
    private $db;

    function __construct()
    {
        $this->db = new Conexion();
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecioTotal($pTotal)
    {
        $this->pTotal = $pTotal;
    }

    public function getPrecioTotal()
    {
        return $this->pTotal;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }
    public function getCedula()
    {
        return $this->cedula;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function showDetails()
    {
        try {
            $sql = "SELECT tabla_detalles_tmp.id_detalle, tabla_productos.descripcion, tabla_detalles_tmp.cantidad,tabla_detalles_tmp.precio, tabla_detalles_tmp.precio_total FROM tabla_productos  INNER JOIN tabla_detalles_tmp 
            ON tabla_productos.id_producto = tabla_detalles_tmp.id_producto";
            $smt = $this->db->prepare($sql);
            $smt->execute();
            return $smt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }

    public function searchClient()
    {
        $datos = [];
        try {
            $sql = "SELECT * FROM tabla_clientes c WHERE c.cedula = :cedula ";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':cedula', $this->getCedula(), PDO::PARAM_STR);
            $smt->execute();
            $cliente =  $smt->fetchAll(PDO::FETCH_OBJ);
            if (sizeof($cliente) > 0) {
                $datos = [
                    'cliente' => [
                        "id" => $cliente[0]->id_cliente,
                        "cedula" => $cliente[0]->cedula,
                        "nombre" => $cliente[0]->nombre,
                        "telefono" => $cliente[0]->telefono,
                        "direccion" => $cliente[0]->direccion

                    ]
                ];
                return $datos;
            } else {
                return  null;
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }

    public function serachProduct()
    {
        $datos = [];
        try {
            $sql = "SELECT * FROM tabla_productos P WHERE P.descripcion = :descripcion";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
            $smt->execute();
            $producto =  $smt->fetchAll(PDO::FETCH_OBJ);
            if (sizeof($producto) > 0) {
                $datos = [
                    'producto' => [
                        "id" => $producto[0]->id_producto,
                        "descripcion" => $producto[0]->descripcion,
                        "stock" => $producto[0]->stock,
                        "precio" => $producto[0]->precio,
                    ]
                ];
                return $datos;
            } else {
                return  null;
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }

    public function insertDetail()
    {
        try {
            $sql = "CALL agregar_detalle(:id,:cantidad,:precio,:total)";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':id', $this->getIdProducto(), PDO::PARAM_INT);
            $smt->bindValue(':cantidad', $this->getCantidad(), PDO::PARAM_INT);
            $smt->bindValue(':precio', $this->getPrecio(), PDO::PARAM_STR);
            $smt->bindValue(':total', $this->getPrecioTotal(), PDO::PARAM_STR);
            $smt->execute();
            if ($smt->rowCount() < 0) {
                return "Error";
            } else {
                return 'ok';
            }
        } catch (PDOException $e) {
            return "Error  " . $e->getMessage();
        }
    }
}
