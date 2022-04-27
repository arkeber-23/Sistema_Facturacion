<?php require_once  './app/views/layout/header.php'; ?>
<div class="bg-body p-3 shadow rounded">
    <form class="m-auto">
        <h3>Editar Cliente</h3>
        <hr>
        <input type="number" class="form-control mt-2" id="id" value="<?= $id ?>" placeholder="id" readonly>
        <input type="number" class="form-control mt-2" id="cedula" value="<?= $cedula ?>" placeholder="Cédula">
        <input type="text" class="form-control mt-2" id="nombre" value="<?= $nombre ?>" placeholder="Nombre">
        <input type="number" class="form-control mt-2" id="telefono" value="<?= $telefono ?>" placeholder="Télefono">
        <input type="text" class="form-control mt-2" id="direccion" value="<?= $direccion ?>" placeholder="Dirección">
        <div class="d-flex row">
            <div class="g-2 ">
                <button class="btn btn-primary my-2 col-md-2" onclick="hola()">
                    Actualizar
                    <i class="fa-solid fa-marker mx-2"></i>
                </button>
            </div>
        </div>
</div>

</form>

<script>
    const hola =async () => {
        event.preventDefault()
        const cliente ={
            id : document.getElementById('id').value,
            cedula : document.getElementById('cedula').value,
            nombre : document.getElementById('nombre').value,
            telefono : document.getElementById('telefono').value,
            direccion : document.getElementById('direccion').value
        }
        const req = await fetch('http://localhost/facturacion/cliente/editar',{
            method:'POST',
            body:JSON.stringify(cliente)
        })
        const resp = await req.json();
        if(resp!='ok'){
            Swal.fire({
                icon:"info",
                text:"No se modificó el cliente, por lo cual no sé actualizara..",
                showConfirmButton:false,
                didOpen: () => {
                setInterval(() => {
                    window.location.href = "http://localhost/facturacion/cliente"
                }, 3000);
            },
            })

        }else{
            Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            text: "Cliente Actualizado..",
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 2000,
            didOpen: () => {
                setInterval(() => {
                    window.location.href = "http://localhost/facturacion/cliente"
                }, 2000);
            },
        });
        }
    }
</script>
<?php require_once  './app/views/layout/footer.php'; ?>