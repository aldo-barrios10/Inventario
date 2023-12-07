<?php 
session_start();
ini_set('display_errors', 0);

if($_SESSION['rol']!= 1){
    header("location:index.php");
}

include_once "../includes/header.php"; ?>



<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
        <a id="btn_add_user" class="btn btn-primary text-white">Nuevo usuario</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                   
                <table class="table table-striped table-bordered" data-paging="true" data-filtering="true" data-sorting="true" data-toggle-column="last" id="table-users">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th data-breakpoints="all">Correo</th>
                            <th data-breakpoints="all">Usuario</th>
                            <th data-breakpoints="all">Rol</th>
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

function loadData() {

    $.ajax({
    url: '../app/controllers/post.php',
    type: 'POST',
    data: { table:"user", action:"selectTable"},
    success: function (response) {

        var datosJSON = response; 
        var datos = JSON.parse(datosJSON);
    
        $('#table-users').footable({
            "columns": [
                { "name": "id", "title": "ID" },
                { "name": "nombre", "title": "Nombre" },
                { "name": "correo", "title": "Correo" },
                { "name": "usuario", "title": "Usuario" },
                { "name": "rol", "title": "Rol" },

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

loadData();

    
});

document.getElementById('btn_add_user').addEventListener('click', function() {

var icon='info';
var selectHTML=''
$.ajax({
        url: '../app/controllers/get.php', 
        method: 'GET',
        dataType: 'json',
        data:{
            action:'getRol'
        },
        success: function(data) {
            console.log(data);
            if (data.length > 0) {
                selectHTML = '<select id="rol" name="rol" class="form-control">';
                data.forEach(function(rol) {
                    selectHTML += '<option value="' + rol.id_rol + '">' + rol.rol + '</option>';
                });
                selectHTML += '</select>';

                Swal.fire({
      
                    title: 'Ingresa los Datos.',
                    html: `
                    <form action="" method="post" class="confirmar_pass">
                        
                        <div class="form-group">
                            <label for="name">Nombre<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el nombre" name="name"
                                id="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido Paterno<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el apellido paterno" name="last_name"
                                id="last_name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="last_name_m">Apellido Materno</label>
                            <input type="text" placeholder="Ingrese el apellido materno" name="last_name_m"
                                id="last_name_m" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="mail">Correo<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese el correo" name="mail" id="mail"
                                class="form-control" value="">
                        </div>

                        <div class="form-group">
                        <label for="rol">Rol</label>
                        `+selectHTML+`
                        </div>

                        <div class="form-group">
                            <label for="user">Usuario<p style="color:red; display:inline;">*</p></label>
                            <input type="text" placeholder="Ingrese un nombre de usuario" name="user" id="user"
                                class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="pass_new">Contraseña<p style="color:red; display:inline;">*</p></label>
                            <input type="password" placeholder="Ingrese una contraseña" name="pass_new" id="pass_new"
                                class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="pass_con">Confirmar contraseña<p style="color:red; display:inline;">*</p></label>
                            <input type="password" placeholder="Ingrese de nuevo la contraseña" name="pass_con" id="pass_con"
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
                      const last_name = document.getElementById('last_name').value;
                      const last_name_m = document.getElementById('last_name_m').value;
                      const mail = document.getElementById('mail').value;
                      const rol = document.getElementById('rol').value;
                      const user = document.getElementById('user').value;
                      const pass_con = document.getElementById('pass_con').value;
                      const pass_new = document.getElementById('pass_new').value;



                
                      if (!name || !last_name || !last_name_m || !mail || !rol || !user || !pass_con|| !pass_new) {
                        Swal.showValidationMessage('Todos los campos son obligatorios');
                      } else {
                        return new Promise((resolve) => {
                          setTimeout(() => {
                            $.ajax({
                              url: '../app/controllers/post.php',
                              method: 'POST',
                              data: {
                                name: name,
                                last_name: last_name,
                                last_name_m: last_name_m,
                                mail: mail,
                                rol:rol,
                                user:user,
                                pass_con:pass_con,
                                pass_new:pass_new,
                                action: 'newUser'
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
    data: { table:"user", action:"selectTable"},
    success: function (response) {

        var datosJSON = response; 
        console.log(response);
        var datos = JSON.parse(datosJSON);
    
        $('#table-users').footable({
            "columns": [
                { "name": "id", "title": "ID" },
                { "name": "nombre", "title": "Nombre" },
                { "name": "correo", "title": "Correo" },
                { "name": "usuario", "title": "Usuario" },
                { "name": "rol", "title": "Rol" },

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

            } else {
                alert('No se encontraron proveedores.');
            }
        },
        error: function(error) {
            alert(error);
            console.log(error);
        }
    });


});


</script>


</body>

</html>


