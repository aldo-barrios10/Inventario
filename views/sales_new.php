<?php include_once "header.php"; ?>
 

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <h4 class="text-center">Datos del Cliente</h4>
                <a class="btn btn-danger text-white btn_clear_client" ><i class="fas fa-broom text-white"></i> Limpiar</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" name="form_new_cliente_venta" id="form_new_cliente_venta">
                        <input type="hidden" name="action" value="addCliente">
                        <input type="hidden" id="idcliente" value="1" name="idcliente" required>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>RFC</label>
                                    <input type="text" name="rfc_client" id="rfc_client" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="name_client" id="name_client" class="form-control" disabled required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="number" name="phone_client" id="phone_client" class="form-control"
                                        disabled required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Colonia</label>
                                    <input type="text" name="col_client" id="col_client" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Calle</label>
                                    <input type="text" name="street_client" id="street_client" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Número Exterior</label>
                                    <input type="text" name="num_ext_client" id="num_ext_client" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Número Interior</label>
                                    <input type="text" name="num_int_client" id="num_int_client" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div id="div_registro_cliente" style="display: none;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h4 class="text-center pt-4">Datos Venta</h4>
            <div id="acciones_venta" class="form-group" style="display: flex; justify-content: center;">
                <a href="#" class="btn btn-danger m-1" id="btn_anular_venta">Anular Venta</a>
                <a class="btn btn-primary text-white m-1" id="btn_facturar_venta"><i class="fas fa-save"></i> Generar
                    Venta</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="100px">Código</th>
                            <th>Des.</th>
                            <th>Stock</th>
                            <th width="100px">Cantidad</th>
                            <th class="textright">Precio</th>
                            <th class="textright">Precio Total</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <td><input type="number" name="txt_cod_producto" id="txt_cod_producto"></td>
                            <td id="txt_descripcion">-</td>
                            <td id="txt_existencia">-</td>
                            <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1"
                                    disabled></td>
                            <td id="txt_precio" class="textright">0.00</td>
                            <td id="txt_precio_total" class="txtright">0.00</td>
                            <td><a href="#" id="add_product_venta" class="btn btn-dark"
                                    style="display: none;">Agregar</a></td>
                        </tr>
                        <tr>
                            <th>Código</th>
                            <th colspan="2">Descripción</th>
                            <th>Cantidad</th>
                            <th class="textright">Precio</th>
                            <th class="textright">Precio Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="detalle_venta">


                    </tbody>

                    <tfoot id="detalle_totales">

                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>


</div>

<script>


    function del_product_detalle(item) {
       
        var id_detail = item;
        $.ajax({
        url: '../app/controllers/modal.php',
        type: "POST",
        async: true,
        data: {action:'delProductDetail',id_detail:id_detail},
        success: function(response) {
            if (response != 0) {
                console.log(response)
                showProducts();
            }else {
            $('#detalle_venta').html('');
            $('#detalle_totales').html('');
    
    
            }
            viewProcesar();
        },
        error: function(error) {
            
        }
        });
    }

    function viewProcesar() {
        if ($('#detalle_venta tr').length > 0){
        $('#btn_facturar_venta').show();
        $('#btn_anular_venta').show();
        }else {
        $('#btn_facturar_venta').hide();
        $('#btn_anular_venta').hide();
        }
    }

    function showProducts(){
        $.ajax({
        url: '../app/controllers/modal.php',
        type: 'POST',
        async: true,
        data: {
                action:'getKart'
            },
        success: function(response) {
            
            if (response != 'error') {
            var info = JSON.parse(response);
            $('#detalle_venta').html(info.detail);
            $('#detalle_totales').html(info.totals);
            $('#txt_cod_producto').val('');
            $('#txt_descripcion').html('-');
            $('#txt_existencia').html('-');
            $('#txt_cant_producto').val('0');
            $('#txt_precio').html('0.00');
            $('#txt_precio_total').html('0.00');


            $('#txt_cant_producto').attr('disabled','disabled');


            $('#add_product_venta').slideUp();
            }else {
            console.log('No hay dato');
            }
            viewProcesar();
        },
        error: function(error) {
            console.log("Hya un error");
        }
        });
    }
document.addEventListener("DOMContentLoaded", showProducts);
</script>

<?php include_once "../includes/footer.php"; ?>