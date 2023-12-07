

function loadClients() {

    $.ajax({
    url: '../app/controllers/post.php',
    type: 'POST',
    data: { table:"client", action:"selectTable"},
    success: function (response) {

        var datosJSON = response; 
        var datos = JSON.parse(datosJSON);
    
        $('#table-clients').footable({
            "columns": [
                { "name": "id", "title": "ID" },
                { "name": "rfc", "title": "RFC" },
                { "name": "nombre", "title": "Nombre" },
                { "name": "telefono", "title": "Teléfono" },
                { "name": "direccion", "title": "Dirección" },
                { "name": "acciones", "title": "Acciones" }

                
            ],
            "rows": datos 
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {
            console.error("Texto de estado: " + textStatus);
            console.error("Error lanzado: " + errorThrown);
    }
    });

}

function loadProducts(){

    $.ajax({
    url: '../app/controllers/post.php',
    type: 'POST',
    data: { table:"product", action:"selectTable"},
    success: function (response) {

        var datosJSON = response; 
        var datos = JSON.parse(datosJSON);
    
        $('#table-products').footable({
            "columns": [
                { "name": "id", "title": "ID" },
                { "name": "descripcion", "title": "Descripcion" },
                { "name": "precio", "title": "Precio" },
                { "name": "existencia", "title": "Existencia" },
                { "name": "proveedor", "title": "Proveedor" },
                { "name": "acciones", "title": "Acciones" }

                
            ],
            "rows": datos 
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {
            console.error("Texto de estado: " + textStatus);
            console.error("Error lanzado: " + errorThrown);
    }
    });



    
}

function loadSales(){
    $.ajax({
        url: '../app/controllers/post.php',
        type: 'POST',
        data: { table:"sale", action:"selectTable"},
        success: function (response) {
    
            var datosJSON = response; 
            console.log(response);
            var datos = JSON.parse(datosJSON);
        
            $('#table-sales').footable({
                "columns": [
                    { "name": "id", "title": "ID" },
                    { "name": "fecha", "title": "Fecha" },
                    { "name": "total", "title": "Total" },
    
                    { "name": "acciones", "title": "Acciones" }
    
                    
                ],
                "rows": datos 
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
                console.error("Texto de estado: " + textStatus);
                console.error("Error lanzado: " + errorThrown);
        }
    });
}

function loadSuppliers(){
    $.ajax({
        url: '../app/controllers/post.php',
        type: 'POST',
        data: { table:"supplier", action:"selectTable"},
        success: function (response) {
    
            var datosJSON = response; 
            var datos = JSON.parse(datosJSON);
        
            $('#table-suppliers').footable({
                "columns": [
                    { "name": "id", "title": "ID" },
                    { "name": "razon_social", "title": "Razón Social" },
                    { "name": "telefono", "title": "Teléfono" },
                    { "name": "direccion", "title": "Dirección" },
                    { "name": "acciones", "title": "Acciones" }
    
                    
                ],
                "rows": datos 
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
                console.error("Texto de estado: " + textStatus);
                console.error("Error lanzado: " + errorThrown);
        }
        });
}

