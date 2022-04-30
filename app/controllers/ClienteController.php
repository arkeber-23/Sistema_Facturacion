<?php

namespace App\controllers;

use App\models\ClienteModelo;

class ClienteController
{
 
  public static function all()
  {
    $clienteModelo = new ClienteModelo();
    $clientes = $clienteModelo->all();
    require_once './app/views/cliente/clienteViews.php';
  }

  public static function insert($cedula, $nombre, $telefono, $direccion)
  {
    $clienteModelo = new ClienteModelo();
    $clienteModelo->setCedula($cedula);
    $clienteModelo->setNombre($nombre);
    $clienteModelo->setTelefono($telefono);
    $clienteModelo->setDireccion($direccion);
    $insertar =  $clienteModelo->insert();
    echo json_encode($insertar);
  }
  public static function edit($id, $cedula, $nombre, $telefono, $direccion)
  {
    $clienteModelo = new ClienteModelo();
    $clienteModelo->setIdCliente($id);
    $clienteModelo->setCedula($cedula);
    $clienteModelo->setNombre($nombre);
    $clienteModelo->setTelefono($telefono);
    $clienteModelo->setDireccion($direccion);
    $editar  = $clienteModelo->edit();
    echo json_encode($editar);
  }
  public static function delete($id)
  {
    $clienteModelo = new ClienteModelo();
    $clienteModelo->setIdCliente($id);
    $eliminar = $clienteModelo->delete();
    echo json_encode($eliminar);
  }

  public static function search($cedula)
  {
    $clienteModelo = new ClienteModelo();
    $clienteModelo->setBuscardor($cedula);
    $clientes = $clienteModelo->search();
    require_once './app/views/cliente/clienteViews.php';
  }
  public static function searchById($buscar)
  {
    $clienteModelo = new ClienteModelo();
    $clienteModelo->setBuscardor($buscar);
    $cliente =  $clienteModelo->searchById();
    extract($cliente);
    require_once './app/views/cliente/editarCliente.php';
  }
}

