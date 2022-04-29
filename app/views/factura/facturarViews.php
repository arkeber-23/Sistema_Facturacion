<?php require_once  './app/views/layout/header.php'; ?>
<div class="bg-light p-3 rounded" style="height: 550px;">
    <div>
        <h3>Nueva Factura</h3>
    </div>
    <hr>

    <div class="text-start m-2">
        <button class="btn text-primary" id="nuevo-cliente">
            Registrar cliente
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="row g">
        <div>
            <input type="text" id="id" placeholder="id_cliente" value="" class="d-none" />
        </div>
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
            <input type="text" class="form-control" id="direccion" value="" placeholder="Dirección" readonly />
        </div>
    </div>
    <div class="row g mt-3">
        <h6 class="text-start">Producto</h6>
        <div>
            <input type="text" id="idP" placeholder="Cedula" value="" class="d-none" />
        </div>
        <div class="col-md-2">
            <input type="text" id="descripcion" class="form-control" placeholder="Descripción" />
        </div>
        <div class="col-md-2">
            <input type="number" id="stock" class="form-control" placeholder="Stock" readonly />
        </div>
        <div class="col-md-2">
            <input type="number" id="cantidad" class="form-control" placeholder="Cantidad" />
        </div>
        <div class="col-md-2">
            <input type="text" id="precio" class="form-control" placeholder="Precio" readonly />
        </div>
        <div class="col-md-2">
            <input type="number" id="precio_total" class="form-control" placeholder="Precio Total" />
        </div>
        <!--boton agregar-->
        <div class="col-md-2">
            <button class="btn text-success" id="boton" onclick="agregar()">
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
    const id = document.getElementById('id')
    const cedula = document.getElementById('cedula')
    const nombre = document.getElementById('nombre')
    const telefono = document.getElementById('telefono')
    const direccion = document.getElementById('direccion')
    const boton_nuevoCliente = document.getElementById('nuevo-cliente')

    const idP = document.getElementById('idP')
    const descripcion = document.getElementById('descripcion')
    const stock = document.getElementById('stock')
    const cantidad = document.getElementById('cantidad')
    const precio = document.getElementById('precio')
    const precio_total = document.getElementById('precio_total')
    const boton_agregar = document.getElementById('boton')

    cedula.addEventListener('keyup', async (e) => {
        e.preventDefault()
        const cd = {
            cedula: e.target.value
        }
        const peticion = await fetch("http://localhost/facturacion/facturar/cliente", {
            method: 'POST',
            body: JSON.stringify(cd)
        })
        const resp = await peticion.json()
        console.log(resp)
        if (resp == null || this.cedula == '') {
            this.id.value = null
            this.nombre.value = ''
            this.telefono.value = ''
            this.direccion.value = ''
            boton_nuevoCliente.classList.remove('d-none')
        } else {
            this.id.value = resp.cliente.id
            this.nombre.value = resp.cliente.nombre
            this.telefono.value = resp.cliente.telefono
            this.direccion.value = resp.cliente.direccion
            boton_nuevoCliente.classList.add('d-none')
        }

    })

    descripcion.addEventListener('keyup', async (e) => {
        e.preventDefault()
        const des = {
            descripcion: e.target.value.toUpperCase()
        }
        const req = await fetch('http://localhost/facturacion/facturar/producto', {
            method: 'POST',
            body: JSON.stringify(des)
        })
        const resp = await req.json()
        if (resp == null || this.descripcion == '') {
            this.idP.value = null
            this.stock.value = ''
            this.precio.value = ''
        } else {
            this.idP.value = resp.producto.id
            this.descripcion.value = resp.producto.descripcion
            this.stock.value = resp.producto.stock
            this.precio.value = resp.producto.precio
        }
    })

    function agregar() {
        const detalle_tmp = {
            idP: this.idP.value,
            cantidad: this.cantidad.value,
            precio: this.precio.value,
            precio_total: this.precio_total.value
        }

        console.log(detalle_tmp)
    }

    cantidad.addEventListener('keyup', (e) => {
        if (this.stock.value < parseInt(this.cantidad.value)) {
            boton_agregar.classList.add('d-none')
        } else {
            boton_agregar.classList.remove('d-none')
            
        }
        
        this.precio_total.value = (this.cantidad.value * this.precio.value).toFixed(2)
    })
</script>
<?php require_once  './app/views/layout/footer.php'; ?>