<?php session_start();
require("../models/conexion.php");
require("./functions.php");



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['action'])) {
        $action = $_GET['action'];

        $actions = [
            'getRol' => 'getRol',
            'getSupplier' => 'getSupplier'
        ];

        if (array_key_exists($action, $actions)) {
            $alert = call_user_func($actions[$action], $conexion);
            echo $alert;

        } else {
            echo "Error desconocido";
        }
    }

}


function getRol($conexion){
    $query_rol = mysqli_query($conexion, "SELECT * FROM rol ORDER BY rol ASC");
    $rols = array();
    while ($rol = mysqli_fetch_assoc($query_rol)) {
        $rols[] = $rol;
    }
    return json_encode($rols);
}

function getSupplier($conexion){
    $query_proveedor = mysqli_query($conexion, "SELECT id_proveedor, razon_social FROM proveedor ORDER BY razon_social ASC");
    $proveedores = array();
    while ($proveedor = mysqli_fetch_assoc($query_proveedor)) {
        $proveedores[] = $proveedor;
    }
    return json_encode($proveedores);
}

