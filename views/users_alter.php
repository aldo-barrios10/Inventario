<?php
include_once "header.php";


if (empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
    header("Location: ../public/products.php");
    exit();
}
$id_usuario = $_REQUEST['id'];

// TODO: CREATE PROCEDURE TO THIS SENTENCE 
$query_usuario = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre, u.correo,u.usuario, r.rol,r.id_rol FROM usuario u inner join  rol r on u.rol_id=r.id_rol WHERE u.id_usuario = '$id_usuario'");
if (mysqli_num_rows($query_usuario) > 0) {
    $data_user = mysqli_fetch_assoc($query_usuario);
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
                    Modificar Usuario
                </div>
                <div class="card-body">
                    <form id="alter-user" method="post">
                    <input type="number" id="id_user" name="id_user" class="form-control" value="<?php echo $data_user['id_usuario']; ?>"
                                disabled style="display:none;">

                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <?php $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
                                  $resultado_rol = mysqli_num_rows($query_rol);
                                  mysqli_close($conexion);
                            ?>
                            <select id="rol" name="rol" class="form-control">
                                <option value="<?php echo $data_user['id_rol']; ?>">
                                    <?php echo $data_user['rol']; ?></option>
                                <?php
                                    if ($resultado_rol > 0) {
                                        while ($rol = mysqli_fetch_array($query_rol)){
                                            
                                           
                                        if($data_user['id_rol']==$rol['id_rol']){
                                            
                                        }else{ ?>
                                            <option value="<?php echo $rol['id_rol']; ?>"> 
                                            <?php echo $rol['rol'];
                                        }                                  
                                        ?>
                                        </option>

                                <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mail">Correo</label>
                            <input type="text" placeholder="Ingrese el nombre del correo" name="mail" id="mail"
                                class="form-control" value="<?php echo $data_user['correo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" placeholder="Ingrese el usuario" name="user" id="user"
                                class="form-control" value="<?php echo $data_user['usuario']; ?>">
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