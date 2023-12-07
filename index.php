
<?php
session_start();
$alert=isset($_SESSION['alert']) ? $_SESSION['alert'] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inventario Graph</title>

  <!-- Custom styles for this template-->
  <link href="resources/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="resources/css/fontawesome.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

  <div class="container ">
    <div class="row justify-content-center mt-5 text-white">
      <h1 style="text-align:center;">Sistema de Inventario ING-GRAPH</h1>
    </div>

    <!-- Div all form-->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!--Image div-->
              <div class="col-lg-6 ">
                <img src="resources/img/logo.png" class="img-fluid"> 
              </div>
              <!--Form div-->
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Iniciar Sesión</h1>
                  </div>
                  <form action= "app/controllers/login.php"class="user" method="POST">
                    <?php echo isset($_SESSION['alert']) ? $_SESSION['alert'] : ""; ?>
                    <div class="form-group">
                      <label>Usuario</label>
                      <input type="text" class="form-control" placeholder="Usuario" name="user"></div>
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" name="pass">
                    </div>
                    <input type="submit" value="Iniciar" class="btn btn-primary text-white">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


</body>

</html>