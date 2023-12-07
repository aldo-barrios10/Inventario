<?php
include_once "header.php";


if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    header("Location: ../public/products.php");
    exit();
}
$id_cliente = $_REQUEST['id'];
    


$query_cliente = mysqli_query($conexion, "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");
if (mysqli_num_rows($query_cliente) > 0) {
    $data_client = mysqli_fetch_assoc($query_cliente);
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
                Modificar Cliente
                </div>
                <div class="card-body">
                    <form  id="alter-client" method="post">
                    <input type="number" id="id_cliente" name="id_cliente" class="form-control" value="<?php echo $data_client['id_cliente']; ?>"
                                disabled style="display:none;">
                        <div class="form-group">
                            <label for="rfc">RFC<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el RFC del cliente" name="rfc" id="rfc"
                                class="form-control" value="<?php echo $data_client['rfc']; ?>">
                                
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre del cliente<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el nombre del cliente" name="nombre" id="nombre"
                                class="form-control" value="<?php echo $data_client['nombre']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el telefono" name="telefono" id="telefono"
                                class="form-control" value="<?php echo $data_client['telefono']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="colonia">Colonia<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese la colonia" name="colonia" id="colonia"
                                class="form-control" value="<?php echo $data_client['colonia']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="calle">Calle<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese la calle" name="calle" id="calle"
                                class="form-control" value="<?php echo $data_client['calle']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero_ext">Numero ext.<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el numero ext." name="numero_ext" id="numero_ext"
                                class="form-control" value="<?php echo $data_client['numero_ext']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero_int">Numero int.</label>
                            <input type="text" placeholder="Ingrese el numero int." name="numero_int" id="numero_int"
                                class="form-control" value="<?php echo $data_client['numero_int']; ?>">
                        </div>
                        <input type="submit" value="Actualizar" class="btn btn-primary text-white">
                        <a href="../public/clients.php" class="btn btn-danger">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


</div>

<?php include_once "../includes/footer.php"; ?>