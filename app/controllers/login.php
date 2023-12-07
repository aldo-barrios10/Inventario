<?php
$alert = '';
session_start();


if (!empty($_SESSION['active'])) {
  header('location: ../../../Inventario/');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['user']) || empty($_POST['pass'])) {
    $alert = '<div class="alert alert-danger" role="alert">
              Ingrese los datos correctamente.
              </div>';

    $_SESSION['alert']= $alert;
    header('location: ../../../Inventario/');
    
  } else {
    require_once "../models/conexion.php";

    $user = mysqli_real_escape_string($conexion, $_POST['user']);
    $pass = md5(mysqli_real_escape_string($conexion, $_POST['pass']));

    $query = "CALL obtener_usuario('$user', '$pass')";
    $result = mysqli_query($conexion, $query);
    mysqli_close($conexion);

    if (!(mysqli_num_rows($result) > 0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Datos incorrectos.
                </div>';

      $_SESSION['alert']= $alert;
      header('location: ../../../Inventario/');
    }
    else{

    $fila = mysqli_fetch_assoc($result);

    if ($fila['id_rol'] == 10) {
      $alert = '<div class="alert alert-danger" role="alert">
                Usuario desactivado.
                </div>';
          header('location: ../../../Inventario/');
          session_destroy();
    } else {

      $_SESSION['active'] = true;
      $_SESSION['id_user'] = $fila['id_usuario'];
      $_SESSION['name'] = $fila['nombre'];
      $_SESSION['email'] = $fila['correo'];
      $_SESSION['user'] = $fila['usuario'];
      $_SESSION['rol'] = $fila['id_rol'];
      $_SESSION['rol_name'] = $fila['rol'];
      $_SESSION['cart'] = [];
      header('location: ../../public/');
    }
  }}
}

?>