<?php require_once  './app/views/layout/header.php'; ?>
<div class="shadow-lg bg-body rounded p-3 ">
    <div class=" mt-3 my-3">
        <h3 class="text-start">Registro de Producto</h3>

    </div>
    <!-- Buscar Cliente-->
    <div class="row my-4">
        <div class="d-flex justify-content-around">
            <div class="col-md-5">
                <button class="btn text-primary" onclick="nuevoProducto()">
                    Nuevo Producto
                    <i class="mx-2 fa.solid fa-plus"></i>
                </button>
            </div>
            <div class="col-md-6 justify-content-end">
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="buscarCliente" class="col-form-label">Buscar Producto:</label>
                    </div>

                    <div class="col-auto d-flex justify-content-center">
                        <input type="text" class="form-control" id="campo-buscar" placeholder="Descripción" />
                        <button class="mx-2 btn btn-success" onclick="buscarProducto()">Buscar</button>
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
                    <th scope="col">Descripción</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($productos) || is_object($productos)) :
                    foreach ($productos as $producto) : ?>
                        <tr class="text-center">
                            <td><?= $producto->id_producto ?></td>
                            <td><?= $producto->descripcion ?></td>
                            <td><?= $producto->stock ?></td>
                            <td><?= $producto->precio ?></td>
                            <td>
                                <a class="btn text-primary" href="<?= BASE_URL ?>/producto/editar/<?= $producto->id_producto ?>">
                                    <i class="fa-solid fa-edit mx-2"></i>
                                    editar
                                </a>
                                |
                                <button class="btn text-danger" onclick="eliminarProducto(<?= $producto->id_producto ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                    eliminar
                                </button>
                            </td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
    function nuevoProducto() {
        Swal.fire({
            html: `<h3>Registrar Producto</h3>
            <input type="text" class="form-control mt-2" id="descripcion" placeholder="Descripcion" >
            <input type="number" class="form-control mt-2" id ="stock" placeholder="stock" >
            <input type="text" class="form-control mt-2" id="precio" placeholder="precio" >
        `,
            confirmButtonText: 'Registrar'
        }).then((result) => {
            if (result.isConfirmed) {
                const datos = {
                    descripcion: document.getElementById('descripcion').value,
                    stock: document.getElementById('stock').value,
                    precio: document.getElementById('precio').value
                }
                if (datos.descripcion == '' || datos.stock == '' || datos.precio == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Por favor llene todos los campos.."
                    })
                } else {
                    fetch('http://localhost/facturacion/producto/registrar', {
                        method: 'POST',
                        body: JSON.stringify(datos)
                    }).then(req => req.json()).then(resp => {
                        if (resp != 'ok') {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "No se puede registrar el producto.."
                            })
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                position: "top-end",
                                text: "producto Registrado..",
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
                    })
                }

            }
        })
    }
    async function eliminarProducto(id) {
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
                fetch("http://localhost/facturacion/producto/eliminar", {
                        method: "POST",
                        body: JSON.stringify(data),
                    })
                    .then((req) => req.json())
                    .then((resp) => {
                        if (resp != 'ok') {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "No se pudo eliminar el producto.."
                            })
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                position: "top-end",
                                text: "Producto Eliminado..",
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

    function buscarProducto() {
        const campo = document.getElementById("campo-buscar").value;
        location.href = "http://localhost/facturacion/producto/buscar/" + campo;
    }
</script>

<?php require_once  './app/views/layout/footer.php'; ?>