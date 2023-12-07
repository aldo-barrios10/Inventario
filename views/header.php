<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
include "../app/models/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventario</title>
    <link rel="stylesheet" href="../resources/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../resources/css/fontawesome.min.css">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">

    <script src="../resources/js/bootstrap.bundle.min.js">
    </script>

    <link rel="stylesheet" href="../resources/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../resources/footable/css/footable.standalone.css">
    <link rel="stylesheet" href="../resources/footable/css/footable.standalone.min.css">




</head>

<body id="page-top">
    <div class="container-fluid p-0">
        <div class="row flex-nowrap">
            <div class="col-auto px-0">
                <div id="sidebar" class="collapse collapse-horizontal show border-end">
                    <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion p-3" id="accordionSidebar">

                            <!-- Sidebar - Brand -->
                            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3"
                                href="index.php">
                                <div class="sidebar-brand-icon rotate-n-5">
                                    <img src="../resources/img/logo.png" class="img-thumbnail img-fluid">
                                </div>
                            </a>

                            <!-- Divider -->
                            <hr class="sidebar-divider my-0">

                            <!-- Divider -->
                            <hr class="sidebar-divider">

                            <!-- Nav Item - Pages Collapse Menu -->
                            <li class="nav-item m-1">
                                <a class="nav-link btn-secondary" href="../public/index.php">
                                    <i class="fas fa-user"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>

                            <!-- Nav Item - Pages Collapse Menu -->
                            <li class="nav-item m-1">
                                <a class="nav-link btn-secondary" href="../public/sales.php">
                                    <i class="fas fa-fw fa-cog"></i>
                                    <span>Ventas</span>
                                </a>
                            </li>

                            <!-- Nav Item - Productos Collapse Menu -->
                            <li class="nav-item m-1">
                                <a class="nav-link btn-secondary" href="../public/products.php">
                                    <i class="fas fa-fw fa-wrench"></i>
                                    <span>Productos</span>
                                </a>
                            </li>

                            <!-- Nav Item - Clientes Collapse Menu -->
                            <li class="nav-item m-1">
                                <a class="nav-link btn-secondary" href="../public/clients.php">
                                    <i class="fas fa-users"></i>
                                    <span>Clientes</span>
                                </a>
                            </li>
                            <!-- Nav Item - Utilities Collapse Menu -->
                            <li class="nav-item m-1">
                                <a class="nav-link btn-secondary" href="../public/suppliers.php">
                                    <i class="fas fa-hospital"></i>
                                    <span>Proveedores</span>
                                </a>
                            </li>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                                <!-- Nav Item - Usuarios Collapse Menu -->
                                <li class="nav-item m-1">
                                    <a class="nav-link btn-secondary" href="../public/users.php">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Usuarios</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            <li>
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span class="text-white" id="date"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <main class="col p-0" style=" height: 100%;">
                <nav class="navbar navbar-expand navbar-light bg-primary text-white topbar mb-4 static-top shadow">

                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="btn btn-info ml-2 "><i
                        class="bi bi-list bi-lg py-2 p1"></i>
                    Menú</a>

                    <ul class="navbar-nav ml-auto mr-2">
                        <li class="nav-item no-arrow ">
                            <form action="../app/controllers/exit.php" method="post" class="logout d-inline">
                                <button class="btn btn-danger" type="submit"><i class="fas fa-sign-out-alt"></i>
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>

                </nav>