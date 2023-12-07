<?php
session_start();
require("../models/conexion.php");
require("./functions.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['action'])) {
        $action = $_POST['action'];

        $actions = [
            'searchClient' => 'searchClient',
            'getKart' => 'getKart',
            'infoProduct' => 'infoProduct',
            'addProductDetail' => 'addProductDetail',
            'proccesSale' => 'proccesSale',
            'viewFact' => 'viewFact' ,
            'changeData' => 'changeData',
            'changePass' => 'changePass',
            'delProductDetail' => 'delProductDetail'
        ];

        if (array_key_exists($action, $actions)) {
            $element = call_user_func($actions[$action], $conexion);
            echo $element;

        } else {
            echo "Error desconocido";
        }
    }

}

function searchClient($conexion){

        $rfc = $_POST['client'];
        $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE rfc LIKE '$rfc'");
        $result = mysqli_num_rows($query);

        $data = '';
        if ($result > 0) {
          $data = mysqli_fetch_assoc($query);
          return json_encode($data,JSON_UNESCAPED_UNICODE);

        }else {
          return null;
        }
    
}

function getKart($conexion){

    $total=0;
    $detailTable='';
    foreach( $_SESSION['cart'] as $item){
        $total= $total+$item[4];
        $unitPrice = number_format((float)$item[3],2,'.', ',');
        $totalPrice = number_format($item[4], 2, '.', ',');
        $detailTable .= '<tr>
            <td>'.$item[0].'</td>
            <td colspan="2">'.$item[1].'</td>
            <td class="textcenter">'.$item[2].'</td>
            <td class="textright">'.$unitPrice.'</td>
            <td class="textright">'.$totalPrice.'</td>
            <td>
                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); del_product_detalle('.$item[0].');"><i class="fas fa-trash-alt"></i> Eliminar</a>
            </td>
        </tr>';
        
    }
    
    $totalDetails = '<tr>
            <td colspan="5" class="textright">Total S/.</td>
            <td class="textright" name="ventaTotal" id="ventaTotal">'.number_format($total, 2, '.', ',').'</td>
        </tr>';
    
    
    $arrayData['detail'] = $detailTable;
    $arrayData['totals'] = $totalDetails;
    return json_encode($arrayData, JSON_UNESCAPED_UNICODE);   

}

function infoProduct($conexion){
    
    $data = "";
    $product_id = $_POST['product'];
    $query = mysqli_query($conexion, "SELECT id_producto, descripcion, precio, existencia FROM producto WHERE id_producto = $product_id");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
        $data = mysqli_fetch_assoc($query);
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    
    }else {
        return 0;
    }

}
function addProductDetail($conexion){
    if (empty($_POST['product']) || empty($_POST['quantity'])) {
        echo json_encode(array('error' => 'Campos incompletos'));
    } else {
        // Resto del código para procesar los datos
        $id_product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $detalleTabla = '';
        $total = 0;
       
        $query_precio = mysqli_query($conexion, "SELECT precio, descripcion FROM producto WHERE id_producto='$id_product'");
        $info_precio = mysqli_fetch_assoc($query_precio);
        $precio = $info_precio['precio'];
        $descripcion = $info_precio['descripcion'];
  
        $precioTotal = round($quantity * $precio, 2);
        
        $compra=[$id_product,$descripcion, $quantity,$precio, $precioTotal];
        array_push($_SESSION['cart'], $compra);
  
  
        foreach( $_SESSION['cart'] as $item){
          $total= $total+$item[4];
          $precioUnidad = number_format((float)$item[3],2,'.', ',');
          $precioTotal = number_format($item[4], 2, '.', ',');
          $detalleTabla .= '<tr>
              <td>'.$item[0].'</td>
              <td colspan="2">'.$item[1].'</td>
              <td class="textcenter">'.$item[2].'</td>
              <td class="textright">'.$precioUnidad.'</td>
              <td class="textright">'.$precioTotal.'</td>
              <td>
                  <a href="#" class="btn btn-danger" onclick="event.preventDefault(); del_product_detalle('.$item[0].');"><i class="fas fa-trash-alt"></i> Eliminar</a>
              </td>
          </tr>';
          
        }
  
        $detalleTotales = '<tr>
              <td colspan="5" class="textright">Total S/.</td>
              <td class="textright" id="ventaTotal">'.number_format($total, 2, '.', ',').'</td>
          </tr>';
  
  
        $arrayData['detalle'] = $detalleTabla;
        $arrayData['totales'] = $detalleTotales;
        return json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    }
}

function proccesSale($conexion){
    $rfc=$_POST['rfc'];
    $result= mysqli_query($conexion, "SELECT id_cliente FROM cliente WHERE rfc='$rfc'");
    $fila = mysqli_fetch_assoc($result);
    $id_cliente=$fila['id_cliente'];
    $carrito=array();
    $total=$_POST['total'];
    $total = str_replace(',', '', $total);
    $total = floatval($total);


    
  
    foreach( $_SESSION['cart'] as $item){
      $aux=array();
      array_push($aux,$item[0]);
      array_push($aux,$item[2]);
      array_push($carrito,$aux);
    }
    $json = json_encode($carrito);
    $user= $_SESSION['id_user'];

    $query = "CALL RealizarCompra('$json', '$total', '$user', '$id_cliente')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $_SESSION['cart']=[];
        return "Venta realizada.";
        
    } else {
        return "Error al realizar la compra.";
    }
}

function viewFact($conexion){

        $token = $_POST['fact_id'];
        
        $query = mysqli_query($conexion, "SELECT * FROM detallefactura WHERE factura_id='$token'");
        $dataArray = array();
        
        if (mysqli_num_rows($query) > 0) {
            while ($fila = mysqli_fetch_assoc($query)) {
                $aux = array();
                $producto_id = $fila['producto_id'];
                $cantidad = $fila['cantidad'];
                $precio_venta = $fila['precio_venta'];
              
                $queryP = "SELECT descripcion FROM producto WHERE id_producto='$producto_id'";
                $resultado = mysqli_query($conexion, $queryP);
                $producto = mysqli_fetch_assoc($resultado)['descripcion'];
      
                array_push($aux, $producto);
                array_push($aux, $cantidad);
                array_push($aux, $precio_venta); 
                array_push($dataArray, $aux);
            }
        
            return json_encode($dataArray, JSON_UNESCAPED_UNICODE);
        } else {
            return "No se encontraron detalles de factura para el token $token";
        }
      
}

function changeData($conexion){
    $name = $_POST['name'];
    $mail=$_POST['mail'];
    $rol=$_POST['rol'];
    $user=$_POST['user'];
    $id_usuario=$_SESSION['id_user'];
  
    $code = '';
    $msg = '';
  
    $query_update = mysqli_query($conexion, "UPDATE usuario SET nombre='$name', correo='$mail', rol_id='$rol', usuario='$user' WHERE id_usuario='$id_usuario'");
    mysqli_close($conexion);  
    if ($query_update) {
      $code = '00';
      $msg = "Datos actualizados, reinicie sesión para verlos reflejados.";
    }else {
      $code = '2';
      $msg = "No es posible actualizar sus datos";
    }
  
    $arrayData = array('cod' => $code, 'msg' => $msg);
    return json_encode($arrayData,JSON_UNESCAPED_UNICODE);
}

function changePass($conexion){
  $pass = md5($_POST['newP']);
  $id_user=$_SESSION['id_user'];
  $actual=md5($_POST['actual']);
  $code = '';
  $msg = '';

  $query = mysqli_query($conexion, "SELECT * from usuario where clave='$actual' and id_usuario='$id_user'");
  
  if(mysqli_num_rows($query)>0){
    $query_update = mysqli_query($conexion, "UPDATE usuario SET clave='$pass' WHERE id_usuario='$id_user'");
    mysqli_close($conexion);  
    if ($query_update) {
      $code = '00';
      $msg = "Contraseña actualizada";
    }else {
      $code = '2';
      $msg = "No es posible actualizar su contraseña";
    }
  }else {
    $code = '1';
    $msg = "La contraseña actual es incorrecta";
  }
  $arrayData = array('cod' => $code, 'msg' => $msg);
  return json_encode($arrayData,JSON_UNESCAPED_UNICODE);
}

function delProductDetail($conexion){
    
    foreach ($_SESSION['cart'] as $item=> $value) {
        if ($value[0] === $_POST['id_detail']){
            unset($_SESSION['cart'][$item]);
            return 1;  
        }
}

}