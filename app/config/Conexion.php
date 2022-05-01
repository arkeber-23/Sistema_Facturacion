<?php
namespace App\config;

use PDO;
use PDOException;

class Conexion  extends PDO
{
    private  $driver = 'mysql:host=localhost;dbname=ferreteria';
    private   $username = 'root';
    private  $password = '';


    public function __construct()
    {
        try {
            $option = [
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE
            ];
             parent::__construct($this->driver, $this->username, $this->password, $option);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
            die();
        }
    }
}

