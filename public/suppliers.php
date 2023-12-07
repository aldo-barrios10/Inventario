<?php include_once "../includes/header.php"; ?>


<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Proveedores</h1>
        <a id="btn_add_supplier" class="btn btn-primary text-white">Nuevo proveedor</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                   
                <table class="table table-striped table-bordered" data-paging="true" data-filtering="true" data-sorting="true" data-toggle-column="last" id="table-suppliers">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th data-breakpoints="all">Teléfono</th>
                            <th data-breakpoints="all">Dirección</th>
                            <?php if ($_SESSION['rol'] == 1) { ?>
                            <th data-breakpoints="all">Acciones</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
						
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>


<?php include_once "../includes/footer.php"; ?>
<script type="text/javascript">
$(document).ready(function () {

loadSuppliers();

});




</script>

</body>

</html>