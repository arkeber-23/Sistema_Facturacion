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

<?php require_once  './app/views/layout/footer.php'; ?>