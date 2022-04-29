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
                        <input type="text" class="form-control" value="<?= $cedula ?? '' ?>" id="campo" placeholder="Cedula" />
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
<script>
    async function nuevo_cliente() {
    Swal.fire({
        html: `<h3>Registrar Cliente</h3>
    <input type="number" class="form-control mt-2" id="cedula"  placeholder="Cedula" >
    <input type="text" class="form-control mt-2" id="nombreCompleto" placeholder="Nombre completo" >
    <input type="number" class="form-control mt-2" id ="telefono" placeholder="Telefono" >
    <input type="text" class="form-control mt-2" id="direccion" placeholder="Dirección" >
    `,
        confirmButtonText: "Registrar",
    }).then((result) => {
        if (result.isConfirmed) {
            const datos = {
                cedula: document.getElementById("cedula").value,
                nombre: document.getElementById("nombreCompleto").value,
                telefono: document.getElementById("telefono").value,
                direccion: document.getElementById("direccion").value,
            };
            fetch("http://localhost/facturacion/cliente/registrar", {
                    method: "POST",
                    body: JSON.stringify(datos),
                })
                .then((res) => res.json())
                .then((resp) => {
                    console.log(resp)
                    if (resp != "ok") {
                        Swal.fire({
                            title: "Error",
                            text: "no se puede registrar el cliente",
                            icons: "error"
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            position: "top-end",
                            text: "Cliente Registrado..",
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 2000,
                            didOpen: () => {
                                setInterval(() => {
                                    location.reload();
                                }, 2000);
                            },
                        });
                    }
                });
        }
    });
}

const buscarCliente = async () => {
    event.preventDefault()
    const cedula = document.getElementById('campo').value
    if (cedula.length <= 0) {
        Swal.fire({
            icon: "warning",
            text: "El campo buscar no puede estar vacío..",
            showConfirmButton: false,
            didOpen: () => {
                setInterval(() => {
                    window.location.href = "http://localhost/facturacion/cliente"
                }, 3000);
            }
        })
    } else {
        location.href = "http://localhost/facturacion/cliente/buscar/" + cedula;
    }
}
    function eliminarCliente(id) {
    Swal.fire({
        title: "¿Esta seguro que desea eliminar?",
        text: "esta operación es irreversible",
        icon: "warning",
        showDenyButton: true,
        denyButtonText: "CANCELAR",
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                id: id,
            };
            fetch("http://localhost/facturacion/cliente/eliminar", {
                    method: "POST",
                    body: JSON.stringify(data),
                })
                .then((res) => res.json())
                .then((resp) => {
                    if (resp != 'ok') {
                        Swal.fire({
                            title: "Error",
                            text: "no se puede registrar el cliente",
                            icons: "error"
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            position: "top-end",
                            text: "Cliente Eliminado..",
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 2000,
                            didOpen: () => {
                                setInterval(() => {
                                    location.reload();
                                }, 2000);
                            },
                        });
                    }
                });
        }
    });
}
</script>
<?php require_once  './app/views/layout/footer.php'; ?>