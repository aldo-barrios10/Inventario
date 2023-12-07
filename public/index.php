<?php include_once "../includes/header.php"; 


?>


<div class="m-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    </div>

    <div >
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Información Personal
                </div>

                <form action="" method="post" name="cambiar_datos" id="cambiar_datos" class="p-3">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="nombre" name="nombre" id="nombre_datos" value="<?php echo $_SESSION['name']; ?>"
                            required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="correo" name="correo" id="correo_datos" value="<?php echo $_SESSION['email']; ?>"
                            placeholder="" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <?php $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
								$resultado_rol = mysqli_num_rows($query_rol);
								mysqli_close($conexion);
						?>
                        <select id="rol_datos" name="rol" class="form-control">
                            <option value="<?php echo $_SESSION['rol']; ?>">
                                <?php echo $_SESSION['rol_name']; ?></option>
                            <?php
								if ($resultado_rol > 0) {
									while ($rol = mysqli_fetch_array($query_rol)){
										
										
									if($_SESSION['rol']==$rol['id_rol']){
										
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
                        <label>Usuario</label>
                        <input type="usuario" name="usuario" id="usuario_datos" value="<?php echo $_SESSION['user']; ?>"
                            required class="form-control">
                    </div>
                    <div class="alertChangePass" style="display:none;"></div>
                    <div>
                        <button type="submit" class="btn btn-primary text-white btnChangePass">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Cambiar contraseña
                </div>
                <div class="card-body">
                    <form method="post" name="cambiar_pass" id="cambiar_pass" class="p-3">
                        <div class="form-group">
                            <label>Contraseña Actual</label>
                            <input type="password" name="actual" id="actual" placeholder="Clave Actual" required
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nueva Contraseña</label>
                            <input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" required
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave"
                                required class="form-control">
                        </div>
                        <div class="alertChangePass" style="display:none;"></div>
                        <div>
                            <button type="submit" class="btn btn-primary text-white btnChangePass">Cambiar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

</main>
</div>
</div>


<?php include_once "../includes/footer.php"; ?>