<?php
include_once "header.php";

if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    header("Location: ../public/products.php");
    exit();
}
    
$id_proveedor = $_REQUEST['id'];



$query_proveedor = mysqli_query($conexion, "SELECT * FROM proveedor WHERE id_proveedor= '$id_proveedor'");
    if (mysqli_num_rows($query_proveedor) > 0) {
        $data_supplier = mysqli_fetch_assoc($query_proveedor);
    } else {
        header("Location: ../public/suppliers.php");
    exit();
    }
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                Modificar Proveedor
                </div>
                <div class="card-body">
                    <form id="alter-supplier" method="post">
                        <input type="number" id="id_proveedor" name="id_proveedor" class="form-control" value="<?php echo $data_supplier['id_proveedor']; ?>"
                                    disabled style="display:none;">
                        <div class="form-group">
                            <label for="nombre">Razón Social </label>
                            <input type="text" placeholder="Ingrese el nombre del proveedor" name="nombre" id="nombre"
                                class="form-control" value="<?php echo $data_supplier['razon_social']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" placeholder="Ingrese el telefono" name="telefono" id="telefono"
                                class="form-control" value="<?php echo $data_supplier['telefono']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="colonia">Colonia<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese la colonia" name="colonia" id="colonia"
                                class="form-control" value="<?php echo $data_supplier['colonia']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="calle">Calle<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese la calle" name="calle" id="calle"
                                class="form-control" value="<?php echo $data_supplier['calle']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero_ext">Numero exterior<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el numero exterior" name="numero_ext" id="numero_ext"
                                class="form-control" value="<?php echo $data_supplier['numero_ext']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero_int">Numero interior</label>
                            <input type="text" placeholder="Ingrese el numero interior" name="numero_int" id="numero_int"
                                class="form-control" value="<?php echo $data_supplier['numero_int']; ?>">
                        </div>
                        <input type="submit" value="Actualizar" class="btn btn-primary text-white">
                        <a href="../public/suppliers.php" class="btn btn-danger">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
</div>

<?php include_once "../includes/footer.php"; ?>