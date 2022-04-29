<?php

use App\controllers\ClienteController;
use App\controllers\FacturaController;
use App\controllers\ProductoController;
use Bramus\Router\Router;

$router = new Router();


$router->get('/', function () {
    require_once './app/views/inicio.phtml';
});

$router->get('/cliente', function () {
    ClienteController::all();
});
$router->get('/cliente/editar/{id}', function ($id) {
    ClienteController::searchById($id);
});
$router->get('/cliente/buscar/{cedula}', function ($cedula) {
    ClienteController::search($cedula);
});
$router->post('/cliente/editar', function () {
    $editar = json_decode(file_get_contents('php://input'), true);
    extract($editar);
    ClienteController::edit($id, $cedula, $nombre, $telefono, $direccion);
});
$router->post('/cliente/registrar', function () {
    $nuevo_cliente = json_decode(file_get_contents('php://input'), true);
    extract($nuevo_cliente);
    ClienteController::insert($cedula, $nombre, $telefono, $direccion);
});

$router->post('/cliente/eliminar', function () {
    $cliente = json_decode(file_get_contents('php://input'), true);
    extract($cliente);
    ClienteController::delete($id);
});
/**
 * Producto
 */
$router->get('/producto', function () {
    ProductoController::all();
});
$router->get('/producto/editar/{id}', function ($id) {
    ProductoController::searchById($id);
});
$router->get('/producto/buscar/{descripcion}', function ($descripcion) {
    ProductoController::search($descripcion);
});
$router->post('/producto/editar', function () {
    $editar = json_decode(file_get_contents('php://input'), true);
    extract($editar);
    ProductoController::edit($id, $descripcion, $stock, $precio);
});
$router->post('/producto/registrar', function () {
    $producto = json_decode(file_get_contents('php://input'), true);
    extract($producto);
    ProductoController::insert($descripcion, $stock, $precio);
});

$router->post('/producto/eliminar', function () {
    $producto = json_decode(file_get_contents('php://input'), true);
    extract($producto);
    ProductoController::delete($id);
});


$router->get('/facturar', function () {
    require_once './app/views/factura/facturarViews.php';
});

$router->post('/facturar/cliente', function () {
    $cliente = json_decode(file_get_contents('php://input'), true);
    extract($cliente);
    FacturaController::searchClient($cedula);
});
$router->post('/facturar/producto', function () {
    $producto = json_decode(file_get_contents('php://input'), true);
    extract($producto);
    FacturaController::searchProduct($descripcion);
});

//Url No valida
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    require_once './app/views/errorPagina.php';
});


$router->run();
