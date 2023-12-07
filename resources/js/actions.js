$(document).ready(function () {


  $('.logout').submit(function (e) {
    e.preventDefault();
    Swal.fire({
      title: '¿Estás seguro de que deseas salir?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
  })


  $('#alter-product').submit(function (e) {
    e.preventDefault(); 

    var id_producto = $('#id_producto').val();
    var proveedor = $('#proveedor').val();
    var descripcion = $('#producto').val();
    var precio = $('#precio').val();

    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            id_producto:id_producto,
            proveedor:proveedor,
            descripcion:descripcion,
            precio:precio,
            action:"alterProduct"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/products.php';
            }
            else{

            }
          })
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });


  $('#add-product').submit(function (e) {
    e.preventDefault(); 

    var producto_id = $('#id_producto').val();
    var cantidad = $('#cantidad').val();
    var existencia = $('#existencia').val();
    var precio = $('#precio').val();


    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            producto_id:producto_id,
            cantidad:cantidad,
            existencia:existencia,
            precio:precio,
            action:"addProduct"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/products.php';
            }
            else{

            }
          })

        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });

  $('#alter-client').submit(function (e) {
    e.preventDefault(); 

    var id_cliente = $('#id_cliente').val();
    var rfc = $('#rfc').val();
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var colonia = $('#colonia').val();
    var calle = $('#calle').val();
    var numero_ext = $('#numero_ext').val();
    var numero_int = $('#numero_int').val();

    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            id_cliente:id_cliente,
            rfc:rfc,
            nombre:nombre,
            telefono:telefono,
            colonia:colonia,
            calle:calle,
            numero_ext:numero_ext,
            numero_int:numero_int,
            action:"alterClient"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/clients.php';
            }
            else{

            }
          })
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });


  $('#alter-client').submit(function (e) {
    e.preventDefault(); 

    var id_cliente = $('#id_cliente').val();
    var rfc = $('#rfc').val();
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var colonia = $('#colonia').val();
    var calle = $('#calle').val();
    var numero_ext = $('#numero_ext').val();
    var numero_int = $('#numero_int').val();

    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            id_cliente:id_cliente,
            rfc:rfc,
            nombre:nombre,
            telefono:telefono,
            colonia:colonia,
            calle:calle,
            numero_ext:numero_ext,
            numero_int:numero_int,
            action:"alterClient"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/clients.php';
            }
            else{

            }
          })
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });

  $('#alter-supplier').submit(function (e) {
    e.preventDefault(); 

    var id_proveedor = $('#id_proveedor').val();
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var colonia = $('#colonia').val();
    var calle = $('#calle').val();
    var numero_ext = $('#numero_ext').val();
    var numero_int = $('#numero_int').val();

    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            id_proveedor:id_proveedor,
            nombre:nombre,
            telefono:telefono,
            colonia:colonia,
            calle:calle,
            numero_ext:numero_ext,
            numero_int:numero_int,
            action:"alterSupplier"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/suppliers.php';
            }
            else{

            }
          })
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });

  $('#alter-user').submit(function (e) {
    e.preventDefault(); 

    var id_user = $('#id_user').val();
    var rol = $('#rol').val();
    var mail = $('#mail').val();
    var user = $('#user').val();


    $.ajax({
        type: 'POST',
        url: '../app/controllers/post.php', 
        data: 
          {
            id_user:id_user,
            rol:rol,
            mail:mail,
            user:user,
            action:"alterUser"
          },
        success: function (response) {
          Swal.fire({
            title: response,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ir a Inicio',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../public/users.php';
            }
            else{

            }
          })
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
  });


  $('.confirmar').submit(function (e) {
    e.preventDefault();
    Swal.fire({
      title: '¿Estás seguro de que deseas eliminar este elemento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
  })

  /* 
  TODO Agregar botón de cancelar creación
  */


  $('.btn_clear_client').click(function (e) {
    e.preventDefault();
    console.log("aaaa");

    $('#rfc_client').prop('disabled', false);
    $('#name_client').prop('disabled', false);
    $('#phone_client').prop('disabled', false);
    $('#col_client').prop('disabled', false);
    $('#street_client').prop('disabled', false);
    $('#num_ext_client').prop('disabled', false);
    $('#num_int_client').prop('disabled', false);

    $('#name_client').val(" ");
    $('#phone_client').val(" ");
    $('#col_client').val(" ");
    $('#street_client').val(" ");
    $('#num_ext_client').val(" ");
    $('#num_int_client').val(" ");


    // Volver a deshabilitar los campos si es necesario
    $('#name_client').prop('disabled', true);
    $('#phone_client').prop('disabled', true);
    $('#col_client').prop('disabled', true);
    $('#street_client').prop('disabled', true);
    $('#num_ext_client').prop('disabled', true);
    $('#num_int_client').prop('disabled', true);

    $('#div_registro_cliente').slideUp();
  });


  $('#rfc_client').keyup(function (e) {
    e.preventDefault();
    var client = $(this).val();

    if (client != '') {
      $.ajax({
        url: '../app/controllers/modal.php',
        type: "POST",
        async: true,
        data: { action: 'searchClient', client: client },
        success: function (response) {

          if (response == 0) {

            // Mostrar botón agregar
            $('#name_client').attr('disabled', 'disabled');
            $('.btn_new_cliente').slideDown();
          } else {
            var data = JSON.parse(response);
            $('#name_client').prop('disabled', false);
            $('#phone_client').prop('disabled', false);
            $('#col_client').prop('disabled', false);
            $('#street_client').prop('disabled', false);
            $('#num_ext_client').prop('disabled', false);
            $('#num_int_client').prop('disabled', false);



            // Establecer los valores en los campos
            $('#name_client').val(data.nombre);
            $('#phone_client').val(data.telefono);
            $('#col_client').val(data.colonia);
            $('#street_client').val(data.calle);
            $('#num_ext_client').val(data.numero_ext);
            $('#num_int_client').val(data.numero_int);


            // Volver a deshabilitar los campos si es necesario
            $('#rfc_client').prop('disabled', true);
            $('#name_client').prop('disabled', true);
            $('#phone_client').prop('disabled', true);
            $('#col_client').prop('disabled', true);
            $('#street_client').prop('disabled', true);
            $('#num_ext_client').prop('disabled', true);
            $('#num_int_client').prop('disabled', true);
            $('#div_registro_cliente').slideUp();
          }
        },
        error: function (error) {
          // Manejar el error si ocurre
        }
      });
    }
  });


  $('#txt_cod_producto').keyup(function (e) {
    e.preventDefault();
    var product = $(this).val();
    if (product == "") {
      $('#txt_descripcion').html('-');
      $('#txt_existencia').html('-');
      $('#txt_cant_producto').val('0');
      $('#txt_precio').html('0.00');
      $('#txt_precio_total').html('0.00');

      //Bloquear Cantidad
      $('#txt_cant_producto').attr('disabled', 'disabled');
      // Ocultar Boto Agregar
      $('#add_product_venta').slideUp();
    }
    if (product != '') {
      $.ajax({
        url: '../app/controllers/modal.php',
        type: "POST",
        async: true,
        data: { action: 'infoProduct', product: product },
        success: function (response) {
          if (response == 0) {
            $('#txt_descripcion').html('-');
            $('#txt_existencia').html('-');
            $('#txt_cant_producto').val('0');
            $('#txt_precio').html('0.00');
            $('#txt_precio_total').html('0.00');

            //Bloquear Cantidad
            $('#txt_cant_producto').attr('disabled', 'disabled');
            // Ocultar Boto Agregar
            $('#add_product_venta').slideUp();
          } else {
            var info = JSON.parse(response);
            $('#txt_descripcion').html(info.descripcion);
            $('#txt_existencia').html(info.existencia);
            $('#txt_cant_producto').val('1');
            $('#txt_precio').html(info.precio);
            $('#txt_precio_total').html(info.precio);
            // Activar Cantidad
            $('#txt_cant_producto').removeAttr('disabled');
            // Mostar boton Agregar
            $('#add_product_venta').slideDown();
          }
        },
        error: function (error) {
        }
      });
      $('#txt_descripcion').html('-');
      $('#txt_existencia').html('-');
      $('#txt_cant_producto').val('0');
      $('#txt_precio').html('0.00');
      $('#txt_precio_total').html('0.00');

      //Bloquear Cantidad
      $('#txt_cant_producto').attr('disabled', 'disabled');
      // Ocultar Boto Agregar
      $('#add_product_venta').slideUp();

    }
  });
  
  $('#add_product_venta').click(function(e) {
    e.preventDefault();
    if ($('#txt_cant_producto').val() > 0) {
      var id_product = $('#txt_cod_producto').val();
      var quantity = $('#txt_cant_producto').val();
      $.ajax({
        url: '../app/controllers/modal.php',
        type: 'POST',
        async: true,
        data: {action:'addProductDetail',product:id_product,quantity:quantity},
        success: function(response) {
          
          if (response != 'error') {;
            var info = JSON.parse(response);
            $('#detalle_venta').html(info.detalle);
            $('#detalle_totales').html(info.totales);
            $('#txt_cod_producto').val('');
            $('#txt_descripcion').html('-');
            $('#txt_existencia').html('-');
            $('#txt_cant_producto').val('0');
            $('#txt_precio').html('0.00');
            $('#txt_precio_total').html('0.00');
  
            // Bloquear cantidad
            $('#txt_cant_producto').attr('disabled','disabled');
  
            // Ocultar boton agregar
            $('#add_product_venta').slideUp();
          }else {
            console.log('No hay dato');
          }
          viewProcesar();
        },
        error: function(error) {
            console.log(error);
        }
      });
    }
  });
  
  $('#txt_cant_producto').keyup(function (e) {
    e.preventDefault();
    var precio_total = $(this).val() * $('#txt_precio').html();
    var existencia = parseInt($('#txt_existencia').html());
    $('#txt_precio_total').html(precio_total);
  
    if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {
      $('#add_product_venta').slideUp();
    } else {
      $('#add_product_venta').slideDown();
    }
  });

  $('#table-products').on('click', '.eliminar', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    
    Swal.fire({
      title: '¿Deseas eliminar este elemento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../app/controllers/post.php',
          method: 'POST',
          data: {
            action:'deleteProduct',
            id: id
          },
          success: function (response) {
            var datosJSON = response; // Aquí debes colocar el JSON que obtienes desde PHP
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
          error: function () {
            console.log("No se eliminó adecuadamente");
          }
        });
      }
    })
  });


  $('#btn_facturar_venta').click(function(e) {
    e.preventDefault();
    var rfc = $('#rfc_client').val();
    var total = $('#ventaTotal').text();

    if ($('#rfc_client').val() != '' && $('#name_client').val() != '') {
      $.ajax({
        url: '../app/controllers/modal.php',
        type: 'POST',
        async: true,
        data: {action:'proccesSale',total:total, rfc:rfc},
        success: function(response) {
          
          Swal.fire({
            title: response,
            icon: 'warning',
            cancelButtonColor: '#d33',
          }).then((result) => {
            if (result.isConfirmed) {
              var tdElement = document.getElementById('detalle_venta');
              tdElement.innerHTML = '';
            }
          })
        },
        error: function(error) {

        }
      });
    }
    else{
      
    }
  });

  $('.confirmar_pass').submit(function (e) {
    e.preventDefault();
    if ($('#pass_con').val() === $('#pass_new').val()) {
      this.submit();
    }
    else {
      Swal.fire({
        title: 'Las contraseñas no coinciden, por favor ingresalas de nuevo',
        icon: 'warning',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.isConfirmed) {

        }
      })
    }
  })

  $(document).on('click', '.view_factura', function() {
    var fact_id = $(this).attr('f');
    
    $.ajax({
        type: 'POST',
        url: '../app/controllers/modal.php', 
        data: { fact_id: fact_id, action:'viewFact' },
        dataType: 'json',
        success: function(data) {

            console.log(data);
            var tableHTML = '<table class="table table-striped table-bordered table-hover text-center">';
            tableHTML += '<thead class="thead-dark">';
            tableHTML += '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th></tr>';
            tableHTML += '</thead>';
            tableHTML += '<tbody>';

            // Agrega filas de datos
            for (var i = 0; i < data.length; i++) {
                tableHTML += '<tr>';
                tableHTML += '<td>' + data[i][0] + '</td>';
                tableHTML += '<td>' + data[i][1] + '</td>';
                tableHTML += '<td>$' + data[i][2] + '</td>';
                tableHTML += '</tr>';
            }

            tableHTML += '</tbody>';
            tableHTML += '</table>';

            Swal.fire({
                title: 'Detalles de la Factura',
                html: tableHTML,
                confirmButtonText: 'Cerrar'
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error en la solicitud Ajax:");
          console.error("Texto de estado: " + textStatus);
          console.error("Error lanzado: " + errorThrown);
          
          if (jqXHR.responseText) {
              console.error("Detalles del error: " + jqXHR.responseText);
          }
            Swal.fire('Error', 'error', 'error');
        }
    });
  });



  /* 
    ! ELIMINAR ESTA FUNCIÓN SI NO HACE NADA
  */


  $('#cambiar_pass').submit(function (e) {
    e.preventDefault();
    var conf = $('#confirmar').val();
    var nueva = $('#nueva').val();
    var exp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!(nueva === conf)) {
      Swal.fire({
        title: 'Las contraseñas no coinciden, por favor ingresalas de nuevo.',
        icon: 'warning',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.isConfirmed) {

        }
      })
      return false;
    }

    if (!exp.test(nueva)) {
      Swal.fire({
        title: 'Las contraseña no es valida, esta debe de tener una mayuscula, una minuscula, un número y debe de tener 8 caracteres.',
        icon: 'warning',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.isConfirmed) {

        }
      })

      return false;
    }
    var actual = $('#actual').val();
    $.ajax({
      url: '../app/controllers/modal.php',
      type: 'POST',
      async: true,
      data: { action:'changePass', actual:actual, newP:nueva },
      success: function (response) {
        if (response != 'error') {
          var info = JSON.parse(response);
          $('#cambiar_pass')[0].reset();
          Swal.fire({
            title: info.msg,
            icon: 'warning',
            cancelButtonColor: '#d33',
          }).then((result) => {
            if (result.isConfirmed) {

            }
          })
        }
      },
      error: function (error) {
        console.log(error)
      }
    });
  })

  $('#cambiar_datos').submit(function (e) {
    e.preventDefault();
    var name = $('#nombre_datos').val();
    var mail = $('#correo_datos').val();
    var rol = $('#rol_datos').val();
    var user = $('#usuario_datos').val();
    var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if (!validEmail.test(mail)) {
      Swal.fire({
        title: 'Correo no valido',
        icon: 'warning',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.isConfirmed) {
        }
      })
      return false;
    }

    if (!(name.length > 2) || !(user.length > 2)) {
      Swal.fire({
        title: 'Nombre o usurio invalidos ',
        icon: 'warning',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if (result.isConfirmed) {

        }
      })

      return false;
    }

    $.ajax({
      url: '../app/controllers/modal.php',
      type: 'POST',
      async: true,
      data: { action: 'changeData', name: name, mail: mail, rol: rol, user: user },
      success: function (response) {
        if (response != 'error') {
          var info = JSON.parse(response);
          Swal.fire({
            title: info.msg,
            icon: 'warning',
            cancelButtonColor: '#d33',
          }).then((result) => {
            if (result.isConfirmed) {

            }
          })
        }
      },
      error: function (error) {
      }
    });
  })


}); 
