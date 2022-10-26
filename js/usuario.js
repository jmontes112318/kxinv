function VerificarUsuario() {
  let usuario = $("#txtUsuario").val();
  let contrasenia = $("#txtContrasenia").val();

  if (usuario.length == 0 || contrasenia.length == 0) {
    return Swal.fire({
      position: "top-end",
      icon: "info",
      title: "Campos vacios,Todos los campos son obligatorios",
      showConfirmButton: false,
      timer: 3000,
    });
  }

  $.ajax({
    url: "../verificarUsuario.php",
    type: "POST",
    data: {
      usuario: usuario,
      contrasenia: contrasenia,
    },
    success: function (response) {
      if (response == 0) {
        return Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Usuario o Contraseña incorrectos",
          showConfirmButton: false,
          timer: 3000,
        });
      } else {
        let data = JSON.parse(response);
        console.log(data);

        if (data[0]["estado"] == 0) {
          return Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Usuario inactivo",
            showConfirmButton: false,
            timer: 3000,
          });
        } else {
          $.ajax({
            url: "../iniciarSesion.php",
            type: "POST",
            data: {
              nombre: data[0]["nombre"],
              usuario: data[0]["usuario"],
              tipoUsusario: data[0]["perfil"],
              idUsuario: data[0]["id"],
            },
            success(respon) {
              location.reload(true);
            },
          });
        }
      }
    },
  });
}

$("#btnLogin").click(function () {
  VerificarUsuario();
});




var tableUsu = $("#tblUsuarios").DataTable({
  dom: "frltip",
  iDisplayLength: 20, // paginacion
  ajax: {
    method: "POST",
    url: "listarUsuarios.php",
  },

  columns: [
    { data: "nombre" },
    { data: "usuario" },
    { data: "perfil" },
    { data: "password" },
    {
      defaultContent:
        '<div class="btn-group"><button class="btn btn-primary botonEditarUser " style ="margin-right: 5px"">Editar</button></div><div class="btn-group"><button class="btn btn-danger botonEliminarUser">Eliminar</button></div>',
    },
  ],
});

// // agregar usuario


  $("#frmAgregarUsuario").submit(function (e) {
    e.preventDefault();
    const $ventanaModalAgreUsu = $("#modalAgregarUsuario");

    const datosAgregar = {
      nombre: $("#agrNombre").val(),
      usuario: $("#agrUsuario").val(),
      password: $("#agrPassword").val(),
      perfil: $("#agrPerfil").val(),      
    };
   

    $.post("agregarUsuario.php", datosAgregar, function (response) {

      if (response != 'ok') {

        return Swal.fire({
          position: "top-end",
          icon: "info",
          title: "Usuario NO agregado",
          showConfirmButton: false,
          timer: 3000,
        });
        
      }
     
      $("#tblUsuarios").DataTable().ajax.reload(null, false);
      $("#agrNombre").val(""),
      $("#agrUsuario").val(""),
      $("#agrPassword").val(""),
      $("#agrPerfil").val(""), 
      $ventanaModalAgreUsu.modal("hide");
    });
  });

  //  pasar datos al modal editar usuario
  let obtenerDatosEditar = function (tbody, table) {
    $(tbody).on("click", "button.botonEditarUser", function () {
      $("#modaEditarUsuario").modal("show");
      let data = tableUsu.row($(this).parents("tr")).data();
      console.log(data);
       $("#editIdusuario").val(data.id);
       $("#editNombre").val(data.nombre);
       $("#editUsuario").val(data.usuario);
       $("#editPerfil").val(data.perfil);
       $("#editPassword").val(data.password);
      
    });
  };
obtenerDatosEditar("#tblUsuarios tbody",tableUsu);

$("#frmEditarUsuario").submit(function (e) {
  e.preventDefault();
  const $ventanaModalEdiUsu = $("#modaEditarUsuario");

  const datosEditar = {
    
   nombre: $("#editNombre").val(),
   usuario: $("#editUsuario").val(),
   perfil: $("#editPerfil").val(),
   password: $("#editPassword").val(),
   id: $("#editIdusuario").val(),
  };
  // console.log(datosEditar);

  $.post("editarUsuario.php", datosEditar, function (response) {
   
    $("#tblUsuarios").DataTable().ajax.reload(null, false);
    $ventanaModalEdiUsu.modal("hide");
  });
});

let eliminarUsuario = function (tbody, table) {
  $(tbody).on("click", "button.botonEliminarUser", function () {
    Swal.fire({
      title: '¿Eliminar Usuario?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {       
        let data = tableUsu.row($(this).parents("tr")).data();
        console.log(data);
        let id = data.id
        $.post("eliminarUsuario.php", { id: id }, function (response) {
          $("#tblUsuarios").DataTable().ajax.reload(null, false);
          
        });
      }
    })
    
    
  });
};
eliminarUsuario("#tblUsuarios tbody",tableUsu);




