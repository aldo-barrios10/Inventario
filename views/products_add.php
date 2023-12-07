<?php
include_once "header.php";


if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    header("Location: ../public/products.php");
    exit();
}

$id_producto = $_REQUEST['id'];
$query_producto = mysqli_query($conexion, "SELECT id_producto, descripcion, precio, existencia FROM producto WHERE id_producto = $id_producto");

if (mysqli_num_rows($query_producto) > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
} else {
    header("Location: ../public/products.php");
    exit();
}
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    Agregar Cantidad
                </div>
                <div class="card-body">
                    <form id="add-product" method="post" class="confrimar">
                        <input type="number" id="id_producto" name="id_producto" class="form-control" value="<?php echo $data_producto['id_producto']; ?>"
                                disabled style="display:none;">
                        <div class="form-group">
                            <label for="precio">Precio Actual</label>
                            <input type="number" id="precioAct" name="precioAct" class="form-control" value="<?php echo $data_producto['precio']; ?>"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="existencia">Cantidad de productos Disponibles</label>
                            <input type="number" id="existencia" name="existencia" class="form-control"
                                value="<?php echo $data_producto['existencia']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="precio">Nuevo Precio</label>
                            <input type="decimal" placeholder="Ingrese nombre del precio" id="precio" name="precio"
                                class="form-control" value="<?php echo $data_producto['precio']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Agregar Cantidad</label>
                            <input type="number" placeholder="Ingrese cantidad" name="cantidad" id="cantidad"
                                class="form-control" value="1">
                        </div>

                        <input type="submit" value="Actualizar" class="btn btn-primary text-white">
                        <a href="../public/products.php" class="btn btn-danger">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "../includes/footer.php"; ?>