<?php include_once "../includes/header.php"; ?>


<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
        <a href="../views/sales_new.php" class="btn btn-primary text-white">Nueva venta</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" data-paging="true" data-filtering="true" data-sorting="true" data-toggle-column="last" id="table-sales">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th data-breakpoints="all">Total</th>
                            <th data-breakpoints="all">Acciones</th>
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
loadSales();
});
    
</script>


</body>

</html>


