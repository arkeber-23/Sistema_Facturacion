<div class="bg-light p-3 rounded" style="height: 550px;">
    <div>
        <h3>Nueva Factura</h3>
    </div>
    <hr>

    <div class="text-start m-2">
        <button class="btn text-primary" :class="validarBotonCliente">
            Registrar cliente
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="row g">
        <div class="col-md-2">
            <input type="text" id="cedula" placeholder="Cedula" value="" class="form-control" />
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="nombre" value="" placeholder="Nombre" readonly />
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" id="telefono" value="" placeholder="Teléfono" readonly />
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"  id="direccion" value="" placeholder="Dirección" readonly />
        </div>
    </div>
    <div class="row g mt-3">
        <h6 class="text-start">Producto</h6>
        <div class="col-md-2">
            <input type="text" id="descripcion" class="form-control" placeholder="Descripción" />
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" placeholder="Stock" readonly />
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" placeholder="Cantidad" />
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Precio" readonly />
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Precio Total" readonly />
        </div>
        <!--boton agregar-->
        <div class="col-md-2">
            <button class="btn text-success">
                <i class="fa-solid fa-plus mx-2"></i>Agregar
            </button>
        </div>
    </div>
    <!--Tabla detalle-->
    <div class="tabla mt-5">
        <table class="table">
            <thead>
                <tr class="bg-dark text-white">
                    <th scope="col">#</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Precio Total</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row">
                        <button class="btn text-danger">
                            <font-awesome-icon icon="trash"></font-awesome-icon>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    const cedula = document.getElementById('cedula')
    const nombre = document.getElementById('nombre')
    const telefono = document.getElementById('telefono')
    const direccion = document.getElementById('direccion')
    cedula.addEventListener('keyup', async (e) => {
        e.preventDefault()
        const cd ={
            cedula : e.target.value
        }
        const peticion = await fetch("http://localhost/sistema/app/api/apiFactura.php", {
            method: 'POST',
            body: JSON.stringify(cd)
        })
       const resp = await peticion.json()
       console.log(resp)
        /*nombre.value = resp.nombre
        telefono.value = resp.telefono
        direccion.value = resp.direccion*/



    })
</script>