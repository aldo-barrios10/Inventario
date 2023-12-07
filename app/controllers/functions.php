<?php 


function getProviderName($conexion, $proveedorId) {
    $query = mysqli_query($conexion, "SELECT razon_social FROM proveedor WHERE id_proveedor='$proveedorId'");
    $data_proveedor = mysqli_fetch_assoc($query);

    return isset($data_proveedor['razon_social']) ? $data_proveedor['razon_social'] : '';
}


function getSaleJSON($conexion, $rol){

    $query = mysqli_query($conexion, "CALL obtener_ventas()");
    $sales=array();

    if (mysqli_num_rows($query)> 0) {
        while ($data = mysqli_fetch_array($query)) {

            $sale=array(
                'id'=>$data['id_factura'],
                'fecha'=>$data['fecha'],
                'total'=>$data['totalfactura'],
                'acciones'=>
                    '<button type="button" class="btn btn-primary text-white view_factura"
                    cl="'.$data['cliente_id'].'"
                    f="'.$data['id_factura'].'">Ver</button>'


            );
            $sales[]=$sale;
         }
    } 
    $salesJSON = json_encode($sales);

    return $salesJSON;
}


function getProductJSON($conexion, $rol) {
    $query = mysqli_query($conexion, "SELECT * FROM producto");
    $result = mysqli_num_rows($query);
    $productos = array(); 

    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $dataID = "" . $data['id_producto'];


            $producto = array(
                'id' => $data['id_producto'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                'existencia' => $data['existencia'],
                'proveedor' => getProviderName($conexion, $data['proveedor_id']),
                'acciones' =>  '
                <a href="../views/products_add.php?id='.$dataID.'" class="btn btn-primary text-white"><i class="fas fa-audio-description"></i></a>
                <a href="../views/products_alter.php?id='.$dataID.'" class="btn btn-success editar"> <i class="fas fa-edit"></i></a>
                <button data-id="'.$dataID.'" class="btn btn-danger eliminar" type="submit"><i class="fas fa-trash-alt"></i></button>
'
            );

            $productos[] = $producto;
        }
    }
    $productosJSON = json_encode($productos);

    return $productosJSON;
}


function getClientJSON($conexion, $rol){
    $query = mysqli_query($conexion, "SELECT * from cliente;");

    $clients=array();
    if (mysqli_num_rows($query)> 0) {
        while ($data = mysqli_fetch_array($query)) {
            $direccion='Col. '.$data['colonia'].', '.$data['calle'].', Num ext. '.$data['numero_ext'];
            if($data['numero_int']!= null){
                $direccion.=', Num int. '.$data['numero_int'];
            }

            $client = array(
                'id' => $data['id_cliente'],
                'rfc' => $data['rfc'],
                'nombre' => $data['nombre'],
                'telefono' => $data['telefono'],
                'direccion' => $direccion,
                'acciones' =>  
                    '<a href="../views/clients_alter.php?id='.$data['id_cliente'].'" class="btn btn-success"><i class="fas fa-edit"></i></a>'

            );
            $clients[] = $client;
        }
    }				
    $clientsJSON = json_encode($clients);

    return $clientsJSON;       
}


function getSupplierJSON($conexion, $rol){

    $query = mysqli_query($conexion, "CALL obtener_proveedor()");
    $suppliers=array();

    if (mysqli_num_rows($query)> 0) {
        while ($data = mysqli_fetch_array($query)) {
            $direccion='Col. '.$data['colonia'].', '.$data['calle'].', Num ext. '.$data['numero_ext'];
            if($data['numero_int']!= null){
                $direccion.=', Num int. '.$data['numero_int'];
            }
            $supplier=array(
                'id'=>$data['id_proveedor'],
                'razon_social'=>$data['razon_social'],
                'telefono'=>$data['telefono'],
                'direccion'=>$direccion,
                'acciones'=>
                    '<a href="../views/suppliers_alter.php?id='.$data['id_proveedor'].'" class="btn btn-success"><i class="fas fa-edit"></i></a>'


            );
            $suppliers[]=$supplier;

        }
    }

    $suppliersJSON = json_encode($suppliers);

    return $suppliersJSON;
}


function getUserJSON($conexion, $rol){

    $query = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre, u.ap_paterno, u.ap_materno, u.correo, u.usuario, r.rol FROM usuario u inner join  rol r  on u.rol_id=r.id_rol");
    $users= array();
    if (mysqli_num_rows($query)> 0) {
        while ($data = mysqli_fetch_array($query)) {
            $nombre=$data['nombre'] . " ". $data['ap_paterno'] . " ".  $data['ap_materno'];

            $user=array(
                'id'=>$data['id_usuario'],
                'nombre'=>$nombre,
                'correo'=>$data['correo'],
                'usuario'=>$data['usuario'],
                'rol'=>$data['rol'],
                'acciones'=>
                '<a href="../views/users_alter.php?id='.$data['id_usuario'].'" class="btn btn-success"><i class="fas fa-edit"></i></a>'
            );
            $users[]=$user;
     }
    } 

    $usersJSON = json_encode($users);

    return $usersJSON;
}

?>
