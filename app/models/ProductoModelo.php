<?php declare(strict_types=1);

namespace App\models;

use App\config\Conexion;
use App\interface\Modelo;
use PDO;
use PDOException;

class ProductoModelo implements Modelo
{
    private $idProducto;
    private $descripcion;
    private $stock;
    private $precio;
    private $buscardor;
    private $db;

    function __construct()
    {
        $this->db = new  Conexion();
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = strtoupper($descripcion);
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }
    public function getStock()
    {
        return $this->stock;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
    public function setBuscador($buscardor)
    {
        $this->buscardor = $buscardor;
    }
    public function getBuscador()
    {
        return $this->buscardor;
    }

    public function all()
    {
        try {
            $sql = "SELECT * FROM tabla_productos";
            $smt = $this->db->prepare($sql);
            $smt->execute();
            return $smt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function insert()
    {
        try {
            $sql = "INSERT INTO tabla_productos (descripcion, stock, precio) VALUES (:descripcion,:stock,:precio)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(':stock', $this->getStock(), PDO::PARAM_STR);
            $stmt->bindValue(':precio', $this->getPrecio(), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return 'ok';
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
    public function edit()
    {
        try {
            $sql = "UPDATE tabla_productos p SET p.descripcion = :descripcion, p.stock=:stock,p.precio=:precio WHERE p.id_producto = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $this->getIdProducto(), PDO::PARAM_INT);
            $stmt->bindValue(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(':stock', $this->getStock(), PDO::PARAM_STR);
            $stmt->bindValue(':precio', $this->getPrecio(), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return 'ok';
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
    public function delete()
    {
        try {
            $sql = "DELETE FROM tabla_productos WHERE id_producto = :id";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':id', $this->getIdProducto(), PDO::PARAM_INT);
            $smt->execute();
            if ($smt->rowCount() > 0) {
                return 'ok';
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }

    public function search()
    {
        try {
            $sql = "SELECT * FROM tabla_productos WHERE tabla_productos.descripcion LIKE concat(:buscar,'%')";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':buscar', $this->getBuscador(), PDO::PARAM_STR);
            $smt->execute();
            if ($smt->rowCount() > 0) {
                return $smt->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
    public function searchById()
    {
        $datos = [];
        try {
            $sql = "SELECT * FROM tabla_productos WHERE tabla_productos.id_producto = :buscar";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':buscar', $this->getBuscador(), PDO::PARAM_STR);
            $smt->execute();
            if ($smt->rowCount() > 0) {
                while ($producto = $smt->fetchAll(PDO::FETCH_OBJ)) {
                    $datos = [
                        "id" => $producto[0]->id_producto,
                        "descripcion" => $producto[0]->descripcion,
                        "stock" => $producto[0]->stock,
                        "precio" => $producto[0]->precio,

                    ];
                }
              
                return $datos;
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
}
