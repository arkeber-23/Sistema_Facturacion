<?php require_once  './app/views/layout/header.php'; ?>

<div class="bg-body p-3 shadow rounded">
    <form class="m-auto">
        <h3>Editar Producto</h3>
        <hr>
        <input type="number" class="form-control mt-2" id="id" value="<?= $id ?>" placeholder="id" readonly>
        <input type="text" class="form-control mt-2" id="descripcion" value="<?= $descripcion ?>" placeholder="Descripción">
        <input type="number" class="form-control mt-2" id="stock" value="<?= $stock ?>" placeholder="Stock">
        <input type="text" class="form-control mt-2" id="precio" value="<?= $precio ?>" placeholder="Precio">
        <div class="d-flex row">
            <div class="g-2 ">
                <button class="btn btn-primary my-2 col-md-2" onclick="actualizar_producto()">
                    Actualizar
                    <i class="fa-solid fa-marker mx-2"></i>
                </button>
            </div>
        </div>
</div>

</form>
<script>
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


</script>
<?php require_once  './app/views/layout/footer.php'; ?>