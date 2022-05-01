<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/sistema/assets/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="http://localhost/facturacion/resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/facturacion/vendor/components/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/facturacion/resources/assets/sweetAlert/sweetalert2.min.css">
    <link rel="shortcut icon" href="<?=BASE_URL?>/resources/img/icon.png" type="image/x-icon">
    <title> LA FERROVIARIA</title>
</head>

<body style="background-color: #D5F5E3;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a style="letter-spacing: 4px;" class="navbar-brand" href="<?= BASE_URL ?>/">FERROVIARIA</a>
            <div class="d-fex justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="<?= BASE_URL ?>/cliente">Cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="<?= BASE_URL ?>/producto">Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="<?= BASE_URL ?>/facturar">Factura</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section class="container my-3">
