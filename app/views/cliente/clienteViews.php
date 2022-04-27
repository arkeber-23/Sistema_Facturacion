<?php require_once  './app/views/layout/header.php'; ?>
<div class="shadow-lg bg-body rounded p-3 ">
    <div class=" mt-3 my-3">
        <h3 class="text-start">Registro de clientes</h3>
    </div>

    <hr>
    <!-- Buscar Cliente-->
    <div class="row my-4">
        <div class="d-flex justify-content-around">
            <div class="col-md-5">
                <button class="btn text-primary" onclick="nuevo_cliente()">
                    Nuevo Cliente
                    <i class="mx-2 fa-solid fa-plus"></i>
                </button>
            </div>
            <div class="col-md-6 justify-content-end">
                <div class="row g-2">
                    <div class="col-md-3">
                        <label for="buscarCliente" class="col-form-label">Buscar Cliente:</label>
                    </div>

                    <div class="col-auto d-flex justify-content-center">
                        <input type="text" class="form-control" value="<?= $cedula ?? '' ?>" id="campo" placeholder="Cedula o Nombre" />
                        <a class="mx-2 btn btn-success" onclick="buscarCliente()">Buscar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="scroll">
        <table class="table ">
            <thead class="text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($clientes) || is_object($clientes)) :
                    foreach ($clientes as $cliente) : ?>
                        <tr class="text-center">
                            <td><?= $cliente->id_cliente ?></td>
                            <td><?= $cliente->cedula ?></td>
                            <td><?= $cliente->nombre ?></td>
                            <td><?= $cliente->telefono ?></td>
                            <td><?= $cliente->direccion ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/cliente/editar/<?= $cliente->id_cliente ?>" class="btn text-primary">
                                    <i class="fa-solid fa-edit mx-2"></i>
                                    editar
                                </a>
                                |
                                <button onclick="eliminarCliente(<?= $cliente->id_cliente; ?>)" class="btn text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                    eliminar
                                </button>
                            </td>
                        </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?php require_once  './app/views/layout/footer.php'; ?>