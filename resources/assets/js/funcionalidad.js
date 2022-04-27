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

/**
 * FUNCIONALIDAD DE LOS PRODUCTOS
 */
 const actualizar_producto = async () => {
    event.preventDefault();
    const cliente = {
        id: document.getElementById("id").value,
        descripcion: document.getElementById("descripcion").value,
        stock: document.getElementById("stock").value,
        precio: document.getElementById("precio").value
    }
    const req = await fetch("http://localhost/facturacion/producto/editar", {
        method: "POST",
        body: JSON.stringify(cliente)
    });
    const resp = await req.json();
    if (resp != 'ok') {
        Swal.fire({
            icon: "info",
            text: "No se modificó el prducto, por lo cual no sé actualizo..",
            showConfirmButton: false,
            didOpen: () => {
                setInterval(() => {
                    window.location.href = "http://localhost/facturacion/producto"
                }, 3000);
            },
        })
    }else{
        Swal.fire({
             toast: true,
             icon: "success",
             position: "top-end",
             text: "Producto Actualizado..",
             timerProgressBar: true,
             showConfirmButton: false,
             timer: 2000,
             didOpen: () => {
                 setInterval(() => {
                     window.location.href = "http://localhost/facturacion/producto"
                 }, 2000);
             },
         });
    }
}