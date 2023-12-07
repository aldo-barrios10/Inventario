try{
document.getElementById('btn_add_product').addEventListener('click', function() {

    var icon='info';
    var selectHTML=''

    $.ajax({
        url: '../app/controllers/get.php', 
        method: 'GET',
        dataType: 'json',
        data:{
            action:'getSupplier'
        },
        success: function(data) {
            if (data.length > 0) {
                selectHTML = '<select id="supplier" name="supplier" class="form-control">';
                data.forEach(function(supplier) {
                    selectHTML += '<option value="' + supplier.id_proveedor + '">' + supplier.razon_social + '</option>';
                });
                selectHTML += '</select>';

                Swal.fire({
      
                    title: 'Ingresa los Datos.',
                    html: `
              
                          <form  method="post">
                              <div class="form-group">
                                  <label for="supplier">Proveedor</label>
                                  `+selectHTML+`
                              </div>
                              <div class="form-group">
                                  <label for="descripcion">Producto</label>
                                  <input type="text" placeholder="Ingrese el nombre o descripción del producto" name="description"
                                      id="description" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                  <label for="quantity">Cantidad</label>
                                  <input type="number" placeholder="Ingrese el nombre del producto" name="quantity"
                                      id="quantity" class="form-control" value=1>
                              </div>
                              <div class="form-group">
                                  <label for="price">Precio</label>
                                  <input type="number" placeholder="Ingrese el precio" name="price" id="price"
                                      class="form-control" value=1000>
                              </div>
                          </form>
                    `,
                    
                    background:'#FFFFFF',
                    showCancelButton: true,
                    confirmButtonColor: '#0B742E',
                    confirmButtonText: 'Agregar',
                    customClass: {
                      confirmButton: 'Agregar',
                      title: 'titulo-personalizado'
                    },
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                      const supplier = document.getElementById('supplier').value;
                      const description = document.getElementById('description').value;
                      const quantity = document.getElementById('quantity').value;
                      const price = document.getElementById('price').value;
                
                      if (!supplier || !description || !quantity || !price ) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                      } else {
                        return new Promise((resolve) => {
                          setTimeout(() => {
                            $.ajax({
                              url: '../app/controllers/post.php',
                              method: 'POST',
                              data: {
                                supplier: supplier,
                                description: description,
                                quantity: quantity,
                                price: price,
                                action: 'newProduct'
                              },
                              success: function(data) {
                                console.log(data);
                                resolve(data);
                              
                              },
                              error: function(e) {
                                  console.log(e)
                              }
                          });
                            
                          }, 1000);
                        });
                      }
                    },
                    allowOutsideClick: () => !Swal.isLoading(),
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire({
                        title:'Mensaje Importante',
                        text:result.value, 
                        icon:icon}
                      );
                      
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
                        error: function(textStatus, errorThrown) {
                              console.error("Texto de estado: " + textStatus);
                              console.error("Error lanzado: " + errorThrown);
                        }
                        });

                    
                    }
                  });

            } else {
                alert('No se encontraron proveedores.');
            }
        },
        error: function(error) {
            alert(error);
            console.log(error);
        }
    });

    
});}
catch(e){

}

try{
document.getElementById('btn_add_client').addEventListener('click', function() {

    var icon='info';
    
    Swal.fire({
      
        title: 'Ingresa los Datos.',
        html: `
    
    <form method="post">
        <div class="form-group">
            <label for="rfc">RFC<p style="color:red; display:inline;">*</p></label>
            <input type="text" placeholder="Ingrese el RFC del cliente" name="rfc"
                id="rfc" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="name">Nombre<p style="color:red; display:inline;">*</p></label>
            <input type="text" placeholder="Ingrese el nombre del cliente" name="name"
                id="name" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono<p style="color:red; display:inline;">*</p></label>
            <input type="number" placeholder="Ingrese el teléfono" name="phone"
                id="phone" class="form-control" value=>
        </div>
        <div class="form-group">
            <label for="colonia">Colonia<p style="color:red; display:inline;">*</p></label>
            <input type="text" placeholder="Ingrese la colonia" name="colonia" id="colonia"
                class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="street">Calle<p style="color:red; display:inline;">*</p></label>
            <input type="text" placeholder="Ingrese la calle" name="street" id="street"
                class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="num_ext">Numero exterior<p style="color:red; display:inline;">*</p></label>
            <input type="text" placeholder="Ingrese el numero exterior" name="num_ext" id="num_ext"
                class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="num_int">Numero interior</label>
            <input type="text" placeholder="Ingrese el numero interior" name="num_int" id="num_int"
                class="form-control" value="">
        </div>
    </form>
        `,
        
        background:'#FFFFFF',
        showCancelButton: true,
        confirmButtonText: 'Agregar',
        customClass: {
          confirmButton: 'Agregar',
          title: 'titulo-personalizado'
        },
        showLoaderOnConfirm: true,
        preConfirm: () => {
          const rfc = document.getElementById('rfc').value;
          const name = document.getElementById('name').value;
          const phone = document.getElementById('phone').value;
          const colonia = document.getElementById('colonia').value;
          const street = document.getElementById('street').value;
          const num_int = document.getElementById('num_int').value;
          const num_ext = document.getElementById('num_ext').value;
    
    
          if (!rfc || !name || !phone || !colonia || !street || !num_int) {
            Swal.showValidationMessage('Todos los campos son obligatorios');
          } else {
            return new Promise((resolve) => {
              setTimeout(() => {
                $.ajax({
                  url: '../app/controllers/post.php',
                  method: 'POST',
                  data: {
                    rfc: rfc,
                    name: name,
                    phone: phone,
                    colonia: colonia,
                    street:street,
                    num_int:num_int,
                    num_ext:num_ext,
                    action: 'newClient'
                  },
                  success: function(data) {
                    console.log(data);
                    resolve(data);
                  
                  },
                  error: function(e) {
                      console.log(e)
                  }
              });
                
              }, 1000);
            });
          }
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title:'Mensaje Importante',
            text:result.value, 
            icon:icon}
          );
          
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
      });
    
});
}
catch(e){

}

try{
    document.getElementById('btn_add_supplier').addEventListener('click', function() {

        var icon='info';
        
        Swal.fire({
          
            title: 'Ingresa los Datos.',
            html: `
        
            <form  method="post">
                <div class="form-group">
                    <label for="name">Nombre<p style="color:red; display:inline;">*</p></label>
                    <input type="text" placeholder="Ingrese el nombre del proveedor" name="name"
                        id="name" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="phonr">Teléfono<p style="color:red; display:inline;">*</p></label>
                    <input type="number" placeholder="Ingrese el teléfono" name="phone"
                        id="phone" class="form-control" value=>
                </div>
                <div class="form-group">
                    <label for="colonia">Colonia<p style="color:red; display:inline;">*</p></label>
                    <input type="text" placeholder="Ingrese la colonia" name="colonia" id="colonia"
                        class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="street">Calle<p style="color:red; display:inline;">*</p></label>
                    <input type="text" placeholder="Ingrese la calle" name="street" id="street"
                        class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="num_ext">Numero exterior<p style="color:red; display:inline;">*</p></label>
                    <input type="text" placeholder="Ingrese el numero exterior" name="num_ext" id="num_ext"
                        class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="num_int">Numero interior</label>
                    <input type="text" placeholder="Ingrese el numero interior" name="num_int" id="num_int"
                        class="form-control" value="">
                </div>
            </form>
            `,
            
            background:'#FFFFFF',
            showCancelButton: true,
            confirmButtonText: 'Agregar',
            customClass: {
              confirmButton: 'Agregar',
              title: 'titulo-personalizado'
            },
            showLoaderOnConfirm: true,
            preConfirm: () => {
              const name = document.getElementById('name').value;
              const phone = document.getElementById('phone').value;
              const colonia = document.getElementById('colonia').value;
              const street = document.getElementById('street').value;
              const num_int = document.getElementById('num_int').value;
              const num_ext = document.getElementById('num_ext').value;
        
        
              if (!name || !phone || !colonia || !street || !num_int) {
                Swal.showValidationMessage('Todos los campos son obligatorios');
              } else {
                return new Promise((resolve) => {
                  setTimeout(() => {
                    $.ajax({
                      url: '../app/controllers/post.php',
                      method: 'POST',
                      data: {
                        name: name,
                        phone: phone,
                        colonia: colonia,
                        street:street,
                        num_int:num_int,
                        num_ext:num_ext,
                        action: 'newSupplier'
                      },
                      success: function(data) {
                        console.log(data);
                        resolve(data);
                      
                      },
                      error: function(e) {
                          console.log(e)
                      }
                  });
                    
                  }, 1000);
                });
              }
            },
            allowOutsideClick: () => !Swal.isLoading(),
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title:'Mensaje Importante',
                text:result.value, 
                icon:icon}
              );
              
              $.ajax({
                url: '../app/controllers/post.php',
                type: 'POST',
                data: { table:"client", action:"selectTable"},
                success: function (response) {
            
                    var datosJSON = response; 
                    var datos = JSON.parse(datosJSON);
                
                    $('#table-suppliers').footable({
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
          });
        
});
}catch(e){

}

