<?php

namespace App\models;

use App\config\Conexion;
use PDO;
use PDOException;

class FacturaModelo
{

    private $cedula;
    private $descripcion;
    private $db;

    function __construct()
    {
        $this->db = new Conexion();
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

    public function searchClient()
    {
        $datos = [];
        try {
            $sql = "SELECT * FROM tabla_clientes c WHERE c.cedula = :cedula ";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':cedula', $this->getCedula(), PDO::PARAM_STR);
            $smt->execute();
            $cliente =  $smt->fetchAll(PDO::FETCH_OBJ);
            if(sizeof($cliente)>0){
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
            }else{
                return  null;
            }
           
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }

    public function serachProduct(){
        $datos = [];
        try {
            $sql = "SELECT * FROM tabla_productos P WHERE P.descripcion = :descripcion";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':descripcion', $this->getDescripcion(), PDO::PARAM_STR);
            $smt->execute();
            $producto =  $smt->fetchAll(PDO::FETCH_OBJ);
            if(sizeof($producto)>0){
                $datos = [
                    'producto' => [
                        "id" => $producto[0]->id_producto,
                        "descripcion" => $producto[0]->descripcion,
                        "stock" => $producto[0]->stock,
                        "precio" => $producto[0]->precio,
                    ]
                ];
                return $datos;
            }else{
                return  null;
            }
           
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
}
