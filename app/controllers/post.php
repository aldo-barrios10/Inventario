<?php
session_start();
require("../models/conexion.php");
require("./functions.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['action'])) {
        $action = $_POST['action'];

        $actions = [
            'selectTable' => 'selectTable',

            'alterProduct' => 'alterProduct', 
            'newProduct' => 'newProduct',
            'addProduct' => 'addProduct',
            'deleteProduct' => 'deleteProduct',
            
            'alterClient' => 'alterClient',
            'newClient'=>'newClient',

            'alterSupplier' => 'alterSupplier',
            'newSupplier'=>'newSupplier',

            'alterUser' => 'alterUser',
            'newUser'=>'newUser'
            
        ];

        if (array_key_exists($action, $actions)) {
            $alert = call_user_func($actions[$action], $conexion);
            echo $alert;

        } else {
            echo "Error desconocido";
        }
    }

}


function selectTable($conexion){
    $table = $_POST['table'];
    try {
        $tableFunctions = array(
            'product' => 'getProductJSON',
            'client' => 'getClientJSON',
            'supplier' => 'getSupplierJSON',
            'user' => 'getUserJSON',
            'sale' => 'getSaleJSON'

        );

        if (array_key_exists($table, $tableFunctions)) {
            $rol = $_SESSION['rol'];
            $json = call_user_func($tableFunctions[$table], $conexion, $rol);
            echo $json;
        } else {
            echo 'Tabla no encontrada';
        }
    } catch (Exception $e) {
        echo $e;
    }
}



function alterProduct($conexion){

    if (!empty($_POST['descripcion']) && !empty($_POST['precio'])) {
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $proveedor_id = $_POST['proveedor'];
        $id_producto = $_POST['id_producto'];


        $query_update = mysqli_query($conexion, "CALL update_producto('$descripcion', '$precio', '$proveedor_id', '$id_producto')");

        if ($query_update !== false) {
            $alert = ' 
                        Producto actualizado con éxito
                        ';
            return $alert;
        } else {
            $alert = '  
                        Producto no se pudo actualizar
                        ';
            return $alert;
        }

    } else {
        $alert = '
                    Campos llenados incorrectamente
                    ';
        return $alert;
    }
}
function newProduct($conexion){
    if (!empty($_POST['quantity']) && (!empty($_POST['price'])) && !empty($_POST['description']) && !empty($_POST['supplier']) && !empty($_POST['price']) >0 && !empty($_POST['quantity'])>0) {
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $supplier= $_POST['supplier'];
        $user_id = $_SESSION['id_user'];

        $query_insert = mysqli_query($conexion, "INSERT INTO producto(descripcion,proveedor_id,precio,existencia,usuario_id) VALUES ('$description','$supplier','$price','$quantity','$user_id')");
        if ($query_insert) {
            $alert='Producto agregado.';
            return $alert;
            
        } else {
            $alert = 'Producto no pudo ser agregado.';
        }
        mysqli_close($conexion);
    } else {
        $alert = 'Campo llenado incorrectamente.';

    }
}
function addProduct($conexion){

    if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $existencia = $_POST['existencia'];
        $producto_id = $_POST['producto_id'];

        $usuario_id = $_SESSION['id_user'];
        $cantidad = $cantidad + $existencia;

        $query_upd = mysqli_query($conexion, "CALL add_producto('$producto_id', '$cantidad', '$precio', '$usuario_id')");

        if ($query_upd) {
            $alert = 'Producto actualizado con éxio.';
            return $alert;
        } else {
            $alert = 'Producto no pudo ser actualizado.';
            return $alert;
        }

    } else {
        $alert = 'Campo llenado incorrectamente';
        return $alert;
    }

}
function deleteProduct($conexion){
    $id_producto = $_POST['id'];
    try {
        $query_delete = mysqli_query($conexion, "DELETE FROM producto WHERE id_producto = '$id_producto'");
        $json = getProductJSON($conexion, $_SESSION['rol']);
        echo $json;
    } catch (Exception $e) {
        echo 1;
    }
}



function alterClient($conexion){
    if (!empty($_POST['rfc']) && !empty($_POST['nombre']) && !empty($_POST['colonia']) && !empty($_POST['numero_ext']) && !empty($_POST['numero_int']) && !empty($_POST['calle']) && !empty($_POST['telefono']) && !empty($_POST['telefono'] > 0)) {
        $telefono = $_POST['telefono'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $numero_ext = $_POST['numero_ext'];

        if (!empty($_POST['rfc'])) {
            $numero_int = $_POST['numero_int'];
        } else {
            $numero_int = null;
        }

        $name = $_POST['nombre'];
        $rfc = $_POST['rfc'];
        $id_cliente = $_POST['id_cliente'];

        while (mysqli_next_result($conexion)) {
            if (!mysqli_more_results($conexion)) {
                break;
            }
        }

        $query_update = mysqli_query($conexion, "CALL update_cliente('$id_cliente','$rfc','$name','$telefono','$colonia','$calle','$numero_ext', '$numero_int')");
        mysqli_close($conexion);
        if ($query_update) {
            $alert = 'Producto actualizado con exito.';
            return $alert;

        } else {
            $alert = 'Producto no se pudo actualizar, ingrese los datos de nuevo.';
            return $alert;
        }

    } else {
        $alert = 'No se ingresaron todos los datos.';
        return $alert;
    }
}
function newClient($conexion){
    if (!empty($_POST['rfc']) && (!empty($_POST['name'])) && !empty($_POST['phone']) && !empty($_POST['colonia']) && !empty($_POST['street']) &&!empty($_POST['num_ext']) && !empty($_POST['phone']) >0) {
        
        $rfc = $_POST['rfc'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $colonia= $_POST['colonia'];
        $street= $_POST['street'];
        $num_ext= $_POST['num_ext'];

        if (!empty($_POST['num_int'])){
            $num_int= $_POST['num_int'];
        }else{
            $num_int= null;
        }
        $user_id = $_SESSION['id_user'];

        $query_insert = mysqli_query($conexion, "INSERT INTO cliente(rfc,nombre,telefono,colonia, calle, numero_ext, numero_int,usuario_id) VALUES ('$rfc','$name','$phone','$colonia', '$street','$num_ext','$num_int','$user_id')");
        if ($query_insert) {
            
            $alert = 'Cliente agregado.';
            return $alert;
            
        } else {
            $alert = 'Cliente no pudo ser agregado.';
            return $alert;

        }

    } else {
        $alert = 'Campos llenados incorrectamente.';
        return $alert;
    }

}



function alterSupplier($conexion){

    if (!empty($_POST['nombre']) || !empty($_POST['colonia']) || !empty($_POST['calle']) || !empty($_POST['numero_ext']) || !empty($_POST['telefono']) && $_POST['telefono'] > 0) {
        $telefono = $_POST['telefono'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $numero_ext = $_POST['numero_ext'];

        if (!empty($_POST['numero_int'])) {
            $numero_int = $_POST['numero_int'];
        } else {
            $numero_int = null;
        }
        $name = $_POST['nombre'];
        $proveedor_id = $_POST['id_proveedor'];
        $usuario_id = $_SESSION['id_user'];

        while (mysqli_next_result($conexion)) {
            if (!mysqli_more_results($conexion)) {
                break;
            }
        }

        $query_update = mysqli_query($conexion, "CALL update_proveedor('$name','$telefono','$colonia','$calle','$numero_ext','$numero_int','$usuario_id', '$proveedor_id')");
        mysqli_close($conexion);
        if ($query_update) {
            $alert = 'Proveedor actualizado con exito.';
            return $alert;
        } else {
            $alert = 'Proveedor no se pudo actualizar.';
            return $alert;
        }

    } else {
        $alert = 'Campo llenado incorrectamente.';
        return $alert;
    }

}
function newSupplier($conexion){
    if ((!empty($_POST['name'])) && !empty($_POST['phone']) && !empty($_POST['colonia']) && !empty($_POST['street']) && !empty($_POST['num_ext']) && !empty($_POST['phone']) >0) {
        
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $colonia= $_POST['colonia'];
        $street= $_POST['street'];
        $num_ext= $_POST['num_ext'];

        if (!empty($_POST['num_int'])){
            $num_int= $_POST['num_int'];
        }else{
            $num_int= null;
        }
        $user_id = $_SESSION['id_user'];

        $query_insert = mysqli_query($conexion, "INSERT INTO proveedor(razon_social,telefono,colonia,calle,numero_ext,numero_int,usuario_id) VALUES ('$name','$phone','$colonia','$street','$num_ext','$num_int','$user_id')");
        mysqli_close($conexion);
        if ($query_insert) {
            $alert = 'Proveedor agregado.';
            return $alert;  
        } else {
            $alert = 'Proveedor no pudo ser agregado.';
            return $alert;
        }      
    } else {
        $alert = 'Campos llenados incorrectamente.';
            return $alert;

    }
}



function alterUser($conexion){

    if (!empty($_POST['mail']) || !empty($_POST['user'])) {

        $usuario = $_POST['user'];
        $correo = $_POST['mail'];
        $id_usuario = $_POST['id_user'];
        $id_rol = $_POST['rol'];

        while (mysqli_next_result($conexion)) {
            if (!mysqli_more_results($conexion)) {
                break;
            }
        }

        $query_update = mysqli_query($conexion, "CALL update_usuario( '$id_usuario','$id_rol','$usuario','$correo')");
        if ($query_update) {
            $alert = 'Usuario actualizado.';
            return $alert;
        } else {
            $alert = 'Usuario no se pudo actualizar.';
            return $alert;
        }

    } else {
        $alert = 'Campo llenado incorrectamente.';
        return $alert;
    }
}
function newUser($conexion){
    if ((!empty($_POST['name'])) && (!empty($_POST['last_name'])) && (!empty($_POST['mail'])) && (!empty($_POST['user'])) && (!empty($_POST['pass_new'])) && (!empty($_POST['pass_con']))) {
        

        if($_POST['pass_new']!== $_POST['pass_con']){
            return $alert="Contraseñas no coinciden.";
        }
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $last_name_m='';
        $mail= $_POST['mail'];
        $user = $_POST['user'];
        $pass=md5($_POST['pass_new']);
        $rol=$_POST['rol'];

        if(!empty($_POST['last_name_m'])){
            $last_name_m=$_POST['last_name_m'];
        }

        $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre,ap_paterno,ap_materno,correo,usuario,clave,rol_id) VALUES ('$name','$last_name','$last_name_m','$mail','$user','$pass','$rol')");
        mysqli_close($conexion);
        if ($query_insert) {
            $alert = 'Usuario agregado.';
            return $alert;            
        } else {
            $alert = 'Usuario no pudo ser agregado.';
            return $alert;
        } 
    } else {
        $alert = 'Campo vacío, por favor llene todos los campos.';
        return $alert;
    }
}


?>