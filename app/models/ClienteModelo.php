<?php declare(strict_types=1);
namespace App\models;

use App\config\Conexion;
use App\interface\Modelo;
use PDO;
use PDOException;

class ClienteModelo implements Modelo
{
    private $id_Cliente;
    private $cedula;
    private $nombre;
    private $telefono;
    private $direccion;
    private $buscador;
    private $db;


    public function setIdCliente($id_Cliente)
    {
        $this->id_Cliente = $id_Cliente;
    }
    public function getIdCliente()
    {
        return $this->id_Cliente;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }
    public function getCedula()
    {
        return $this->cedula;
    }

    public function setNombre($nombre)
    {
        $this->nombre = trim(strtoupper($nombre));
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = trim($telefono);
    }
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = trim(strtoupper($direccion));
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setBuscardor($buscador)
    {
        $this->buscador = trim(strtoupper($buscador));
    }
    public function getBuscardor()
    {
        return $this->buscador;
    }

    function __construct()
    {
        $this->db = new Conexion();
    }
  
    public function all()
    {
        $sql = "SELECT * FROM tabla_clientes";
        $smt = $this->db->prepare($sql);
        $smt->execute();
        return $smt->fetchAll(PDO::FETCH_OBJ);
    }
   
    public function insert()
    {
        try {
            $sql = "INSERT INTO tabla_clientes (cedula, nombre, telefono, direccion) VALUES (:cedula,:nombre,:telefono,:direccion)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':cedula', $this->getCedula(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre', $this->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $this->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $this->getDireccion(), PDO::PARAM_STR);
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
            $sql = "UPDATE tabla_clientes c SET c.cedula = :cedula, c.nombre=:nombre,c.telefono=:telefono , c.direccion=:direccion WHERE c.id_cliente = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $this->getIdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(':cedula', $this->getCedula(), PDO::PARAM_STR);
            $stmt->bindValue(':nombre', $this->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $this->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $this->getDireccion(), PDO::PARAM_STR);
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
            $sql = "DELETE FROM tabla_clientes WHERE id_cliente = :id";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':id', $this->getIdCliente(), PDO::PARAM_INT);
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
            $sql = "SELECT * from tabla_clientes c WHERE c.cedula LIKE CONCAT(:cedula,'%')";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':cedula', $this->getBuscardor(), PDO::PARAM_STR);
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
            $sql = "SELECT * FROM tabla_clientes WHERE tabla_clientes.id_cliente = :buscar";
            $smt = $this->db->prepare($sql);
            $smt->bindValue(':buscar', $this->getBuscardor(), PDO::PARAM_STR);
            $smt->execute();
            if ($smt->rowCount() > 0) {
                while ($cliente = $smt->fetchAll(PDO::FETCH_OBJ)) {
                    $datos = [
                        "id" => $cliente[0]->id_cliente,
                        "cedula" => $cliente[0]->cedula,
                        "nombre" => $cliente[0]->nombre,
                        "telefono" => $cliente[0]->telefono,
                        "direccion" => $cliente[0]->direccion,
                    ];
                }
                return $datos;
            }
        } catch (PDOException $e) {
            return "Error " . $e->getMessage();
        }
    }
}


?>