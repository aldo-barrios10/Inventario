<?php include_once "../includes/header.php"; ?>



<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Productos</h1>
        <a class="btn btn-primary text-white " id="btn_add_product">Nuevo Producto</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table  table-striped table-bordered" data-paging="true" data-filtering="true" data-sorting="true" data-toggle-column="last" id="table-products">
                    <thead class="thead-dark">
                        <tr>
                            <th data-breakpoints="xs">ID</th>
                            <th>Producto</th>
                            <th data-breakpoints="xs">Precio</th>
                            <th data-breakpoints="xs">Existencia</th>
                            <th>Proveedor</th>
                            <th data-breakpoints="all" >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
</div>

</div>
</div>
</div>


<?php include_once "../includes/footer.php"; ?>

<script>
$(document).ready(function () {
loadProducts();
});
</script>




</body>

</html>