<?php
include_once "header.php";


if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    header("Location: ../public/products.php");
    exit();
}

$id_producto = $_REQUEST['id'];
$query_producto = mysqli_query($conexion, "SELECT p.descripcion, p.precio, p.id_producto, pr.id_proveedor, pr.razon_social FROM producto p INNER JOIN proveedor pr ON p.proveedor_id=pr.id_proveedor WHERE p.id_producto = $id_producto");

if (mysqli_num_rows($query_producto) > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
} else {
    header("Location: ../public/productos.php");
    exit();
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Modificar Producto
                </div>
                <div class="card-body">
                    <form id="alter-product" method="post" class="confirmar">
                        <div class="form-group">
                        <input type="number" name="id_producto" id="id_producto" class="form-control" value="<?php echo $data_producto['id_producto']; ?>"  style="display: none;">   
                        <label for="proveedor">Proveedor</label>
                            <select id="proveedor" name="proveedor" class="form-control">
                                <option value="<?php echo $data_producto['id_proveedor']; ?>">
                                    <?php echo $data_producto['razon_social']; ?>
                                </option>
                                <?php
                                $query_proveedor = mysqli_query($conexion, "SELECT * FROM proveedor ORDER BY razon_social ASC");

                                if ($query_proveedor) {
                                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                                        if ($data_producto['id_proveedor'] != $proveedor['id_proveedor']) {
                                ?>
                                            <option value="<?php echo $proveedor['id_proveedor']; ?>">
                                                <?php echo $proveedor['razon_social']; ?>
                                            </option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Producto</label>
                            <input type="text" placeholder="Ingrese el nombre del producto" name="producto"
                                id="producto" class="form-control"
                                value="<?php echo htmlspecialchars($data_producto['descripcion']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="decimal" placeholder="Ingrese el precio" name="precio" id="precio"
                                class="form-control" value="<?php echo $data_producto['precio']; ?>">
                        </div>
                        <input  type="submit"  value="Enviar" class="btn btn-primary text-white">
                        <a href="../public/products.php" class="btn btn-danger">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once "../includes/footer.php"; ?>