$(document).ready(function () {
  // $("#registroInventario").keypress(function (e) {
  //   if (e.which == 13) {
  //     return false;
  //   }
  // });
  let formato = new Intl.NumberFormat("eng-US", {
    style: "currency",
    currency: "USD",
    maximumFractionDigits: 0,
  });

  function listarRegistros() {
    let usuario = $("#usuario").val();
    let perfil = $("#txtPerfil").val();

    $.ajax({
      url: "listarRegistros.php",
      type: "POST",
      data: {
        usuario: usuario,
        perfil: perfil,
      },
      success: function (response) {
        registros = JSON.parse(response);
        console.log(registros);
        let template = "";

        registros.forEach((regist) => {
          template += `
          <tr idRegistro=${regist.id}>
          <td>${regist.usuario}</td>
          <td>${regist.codigo}</td>
          <td>${regist.lote}</td>
          <td>
              <a class="editCatidad" href="#" data-toggle="modal" data-target="#modificarCantidad">${regist.cantidad}</a>        
          </td>
        
          <td>${regist.descripcion}</td>
          <td>${regist.barra}</td>
          <td>${regist.ubicacion}</td>
          <td>${regist.conteo}</td>              
          
              <td>
                <button class="eliminarRegistro btn btn-danger">
                  eliminar 
                </button>
              </td> 
              
          </tr>
           `;
        });

        $("#tblResumen").html(template);
        // console.log(registros);
      },
    });
  }

  listarRegistros();

  // buscar por codigo de barra

  $("#registroInventario").on("change", "input.barra", function (e) {
    let barra = $("#barra").val();
    let opciones = "";
    $.ajax({
      url: "buscarBarra.php",
      type: "POST",
      data: { barra },
      success: function (response) {
        let product = JSON.parse(response);
        let bandera = product.length;
        console.log(product);

        if (bandera === 0) {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Codigo de Barra no exite ",
            showConfirmButton: false,
            timer: 3000,
          });
        } else {
          if (bandera === 1) {
            $("#codigo").val(product[0]["codigo"]);
            $("#descripcion").val(product[0]["descripcion"]);
            $("#idlote").val(product[0]["id"]);
            $("#reflote").val(product[0]["lote"]);
            $("#ubicacionP").val(product[0]["ubicacion"]);
            $("#pasilloR").val(product[0]["pasillo"]);
            $("#costoR").val(product[0]["costo"]);
            $("#estanteR").val(product[0]["estante"]);
            $("#cantidad").focus();
          } else {
            let lote = false;

            for (let i = 0; i < product.length; i++) {
              if (product[i]["lote"] !== "") {
                lote = true;
                break;
              }
            }
            if (lote) {
              $("#codigo").val(product[0]["codigo"]);
              $("#descripcion").val(product[0]["descripcion"]);
              $("#ubicacionP").val(product[0]["ubicacion"]);
              $("#pasilloR").val(product[0]["pasillo"]);
              $("#costoR").val(product[0]["costo"]);
              $("#estanteR").val(product[0]["estante"]);

              $("#modalSelecionarLote").modal("show");
              $("#buscarLote").focus();

              let template = "";
              for (let i = 0; i < product.length; i++) {
                if (product[i]["lote"] != "") {
                  template += `
                  <tr idlote=${product[i]["id"]}>
                  <td refL= ${product[i]["lote"]}>
                  <a class="sLote" href="#" >${product[i]["lote"]}</a>  
                  </td>                
                
                  <td>${product[i]["vencimiento"]}</td>
                              
                  </tr>
                  `;
                }
              }

              $("#selecLote").html(template);

              $(document).on("click", ".sLote", function () {
                let elemento = $(this)[0].parentElement.parentElement;
                let elemento1 = $(this)[0].parentElement;
                let id = $(elemento).attr("idlote");
                let el1 = $(elemento1).attr("refL");
                $("#idlote").val(id);
                $("#reflote").val(el1);
                $("#modalSelecionarLote").modal("hide");
                $("#cantidad").focus();
              });

              const buscarLote = document.querySelector("#buscarLote");
              const tabla = document.querySelector("#selecLote");

              const filtrarLotes = () => {
                tabla.innerHTML = "";
                const texto = buscarLote.value.toUpperCase();
                // let bLote = $("#buscarLote").val().toUpperCase();

                for (let pr of product) {
                  let lote = pr.lote;
                  if (lote.indexOf(texto) !== -1) {
                    tabla.innerHTML += `
                    <tr idlote=${pr.id}>
                    <td refL= ${pr.lote}>
                    <a class="sLote" href="#" >${pr.lote}</a>
                    </td>

                    <td>${pr.vencimiento}</td>

                    </tr>
                    `;
                  }
                }
                if (tabla.innerHTML === "") {
                  tabla.innerHTML += `
                  <tr >
                  <td >
                  <a class="crear_lote" href="#" >Crear Lote</a>
                  </td>                

                  </tr>
                  `;
                }
              };

              buscarLote.addEventListener("keyup", filtrarLotes);
            }
          }
        }
      }, // fin del response
    });
  });

  // Registrar Productos

  function registrarProducto() {
    let conteo = $("input:radio[name=area]:checked").val().toUpperCase();

    const datosPos = {
      conteo: conteo,
      ubicacion: $("#ubicacion").val(),
      usuario: $("#usuario").val(),
      codigo: $("#codigo").val(),
      descripcion: $("#descripcion").val(),
      idlote: $("#idlote").val(),
      lote: $("#reflote").val(),
      cantidad: $("#cantidad").val(),
      barra: $("#barra").val(),
    };

    $.post("registro.php", datosPos, function (response) {
      listarRegistros();
      $("#inv").DataTable().ajax.reload(null, false);
      limpiarFrmTomaInv();
      $("#buscarLote").val("");
      numInconsistencia();
      ValorRegistrado();
      numFaltantes();
      valorDiferencia();
      numItemsSobrantres();
    });
  }

  //// enviar datos del formulario ///

  $("#registroInventario").submit(function (e) {
    e.preventDefault();
    const validaDatos = {
      ubicacion: $("#ubicacion").val(),
      idlote: $("#idlote").val(),
    };

    $.post("validarRegistro.php", validaDatos, function (response) {
      // console.log(response);
      if (response === "1") {
        if (
          confirm(
            "Producto ya fue ingresado en esta dirección,quiere anexar un nuevo registro"
          )
        ) {
          registrarProducto();
        }
      } else {
        registrarProducto();
      }
    });
  });

  //////  limpiar formulario /////

  $("#btnlimpiar").click(function () {
    limpiarFrmTomaInv();
  });

  ///// validar cantidad /////

  // function validarCantidad() {
  // $("#cantidad").on("change", function () {
  //   let cantidad = parseInt($("#cantidad").val());
  //   let idlote = $("#idlote").val();

  //   $.ajax({
  //     url: "evaluarCantidad.php",
  //     type: "POST",
  //     data: { idlote },
  //     success: function (response) {
  //       // console.log(response);

  //       let valores = JSON.parse(response);
  //       // console.log(valores);
  //       let stock = parseInt(valores[0]["stock"]);
  //       let ingresadas = parseInt(valores[0]["cant_ingresada"]);

  //       // console.log(stock);
  //       // console.log(cantidad);

  //       let sumaCantidades = cantidad + ingresadas;

  //       // console.log(sumaCantidades);

  //       if (sumaCantidades === stock) {
  //         document.getElementById("alerta").style.backgroundColor = "green";
  //         // registrarProducto();
  //         document.getElementById("barra").focus();
  //       } else {
  //         if (sumaCantidades > stock) {
  //           document.getElementById("alerta").style.backgroundColor = "yellow";
  //         } else {
  //           document.getElementById("alerta").style.backgroundColor = "red";

  //           document.getElementById("barra").focus();
  //         }
  //       }
  //     },
  //   });
  // }); // fin validar sumaCantidades
  // }

  //// Eliminar Registro ///////////

  $(document).on("click", ".eliminarRegistro", function () {
    if (confirm("Esta seguro de Eliminar Tarea")) {
      let elemento = $(this)[0].parentElement.parentElement;
      let id = $(elemento).attr("idRegistro");
      // console.log(id);
      $.post("eliminarRegistro.php", { id: id }, function (response) {
        listarRegistros();
        numInconsistencia();
        ValorRegistrado();
        numFaltantes();
        valorDiferencia();
        numItemsSobrantres();
        // console.log(response);
      });
    }
  });

  //// Editar Registro Registro ///////////

  $(document).on("click", ".editCatidad", function () {
    // if (confirm("Esta seguro de Editar Tarea")) {
    let elemento = $(this)[0].parentElement.parentElement;
    let id = $(elemento).attr("idRegistro");
    // console.log(id);
    $.post("obtenerRegistro.php", { id: id }, function (response) {
      let registros = JSON.parse(response);
      $("#eubicacion").val(registros.ubicacion);
      $("#eusuario").val(registros.usuario);
      $("#ebarra").val(registros.barra);
      $("#ecodigo").val(registros.codigo);
      $("#edescripcion").val(registros.descripcion);
      $("#ereflote").val(registros.lote);
      $("#eidlote").val(registros.idlote);
      $("#ecantidad").val(registros.cantidad);
      $("#eidRegistro").val(registros.id);
      // editar = true;
    });
    // }
  });

  $("#modificarRegistro").submit(function (e) {
    e.preventDefault();
    const $ventanaModal = $("#modificarCantidad");

    const datosEditar = {
      ubicacion: $("#eubicacion").val(),
      usuario: $("#eusuario").val(),
      codigo: $("#ecodigo").val(),
      descripcion: $("#edescripcion").val(),
      idlote: parseInt($("#eidlote").val()),
      lote: $("#ereflote").val(),
      cantidad: parseInt($("#ecantidad").val()),
      barra: $("#ebarra").val(),
      id: $("#eidRegistro").val(),
    };
    // console.log(datosEditar);

    $.post("editarRegistro.php", datosEditar, function (response) {
      // console.log(response);
      listarRegistros();
      $("#eubicacion").val("");
      $("#eusuario").val("");
      $("#ebarra").val("");
      $("#ecodigo").val("");
      $("#edescripcion").val("");
      $("#ereflote").val("");
      $("#eidlote").val("");
      $("#ecantidad").val("");
      $("#eidRegistro").val("");

      if (response === "ok") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Registro modificdo",
          showConfirmButton: false,
          timer: 1000,
        });
        $("#inv").DataTable().ajax.reload(null, false);

        numInconsistencia();
        ValorRegistrado();
        numFaltantes();
        valorDiferencia();
        numItemsSobrantres();
      }

      $ventanaModal.modal("hide");
    });
  });

  // busqueda registros en tabla resumen
  $("#buscar").keyup(function (e) {
    if ($("#buscar").val()) {
      let search = $(this).val();

      $.ajax({
        url: "buscarRegistros.php",
        type: "POST",
        data: { search },
        success: function (response) {
          let registros = JSON.parse(response);
          let tabla = "";
          registros.forEach((regist) => {
            tabla += `
              <tr idRegistro=${regist.id}>
              <td>${regist.usuario}</td>
              <td>${regist.codigo}</td>
              <td>${regist.lote}</td>
              <td>
                  <a class="editCatidad" href="#" data-toggle="modal" data-target="#modificarCantidad">${regist.cantidad}</a>        
              </td>
            
              <td>${regist.descripcion}</td>
              <td>${regist.barra}</td>
              <td>${regist.ubicacion}</td>             
              <td>${regist.conteo}</td>
                  <td>
                    <button class="eliminarRegistro btn btn-danger">
                      eliminar 
                    </button>
                  </td> 
                  
              </tr>
               `;
          });

          $("#tblResumen").html(tabla);
        },
      });
    } else {
      listarRegistros();
    }
  });

  ///////////////////////////////////////////////////////////////////////////////////////////////
  //////////////// BLOQ DE CODIGO PARA INVENTARIO GENERAl E INCONSISTENCIAS///////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////////

  //// evaluar lote a crear ///

  $(document).on("click", ".crear_lote", function () {
    btnCrLt.disabled = true;
    $("#modalSelecionarLote").modal("hide");
    $("#modalCrearLote").modal("show");
    let barra_modal = $("#barraL").val($("#barra").val());
    let codigo_modal = $("#ncodigo").val($("#codigo").val());
    let descripcion_modal = $("#ndescripcion").val($("#descripcion").val());
    let ubicacion_modal = $("#nubicacion").val($("#ubicacionP").val());
    let costo_modal = $("#ncosto").val($("#costoR").val());
    let pasillo_modal = $("#npasillo").val($("#pasilloR").val());
    let estante_modal = $("#nestante").val($("#estanteR").val());
    let lote_lodal = $("#nlote").val($("#buscarLote").val());
    frmLt.addEventListener("keyup", activarBtnCrearLote);
  });

  let frmLt = document.querySelector("#crearLote");
  let btnCrLt = document.querySelector("#btnCrearLote");

  function activarBtnCrearLote() {
    let desabilitado = false;

    if (frmLt.ncantidad.value === "") {
      desabilitado = true;
    }

    if (frmLt.nvencimiento === "") {
      desabilitado = true;
    }

    if (desabilitado === true) {
      btnCrLt.disabled = true;
    } else {
      btnCrLt.disabled = false;
    }
  }

  $("#crearLote").submit(function (e) {
    e.preventDefault();
    const $ventanaModal = $("#modalCrearLote");

    let nlote = $("#nlote").val().toUpperCase();

    let ncodigo = $("#ncodigo").val();

    // nlote.toUpperCase();
    const validaDatos = {
      lote: nlote,
      codigo: ncodigo,
    };

    $.post("validarLote.php", validaDatos, function (response) {
      // console.log(response);
      if (response === "1") {
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "LOTE YA EXISTE",
          showConfirmButton: false,
          timer: 2000,
        });

        $ventanaModal.modal("hide");
      } else {
        crearLoteProducto();
        limpiarModalLotes();
        $ventanaModal.modal("hide");
        numInconsistencia();
        ValorRegistrado();
        numFaltantes();
        valorDiferencia();
        numItemsSobrantres();
      } // fin si valida si trae regitro "1"
    });
  });

  //// enviar datos para crear lote ///

  function crearLoteProducto() {
    const datosPos = {
      barra: $("#barraL").val(),
      codigo: $("#ncodigo").val(),
      descripcion: $("#ndescripcion").val(),
      lote: $("#nlote").val().toUpperCase(),
      vencimiento: $("#nvencimiento").val(),
      pasillo: $("#npasillo").val(),
      estante: $("#nestante").val(),
      stock: parseInt($("#nstock").val()),
      cantidad: parseInt($("#ncantidad").val()),
      ubicacion: $("#nubicacion").val(),
      costo: parseInt($("#ncosto").val()),
    };

    $.post("registrarLote.php", datosPos, function (response) {
      if (response === "ok") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "LOTE CREADO!!",
          showConfirmButton: false,
          timer: 1500,
        });
        listarRegistros();
        $("#inv").DataTable().ajax.reload(null, false);
        limpiarModalLotes();
        limpiarFrmTomaInv();
        $("#buscarLote").val("");
      }
    });
  }

  function limpiarFrmTomaInv() {
    $("#codigo").val("");
    $("#descripcion").val("");
    $("#idlote").val("");
    $("#reflote").val("");
    $("#cantidad").val("");
    $("#pasilloR").val("");
    $("#estanteR").val("");
    $("#costoR").val("");
    $("#barra").val("");
    $("#barra").focus();
  }

  function limpiarModalLotes() {
    $("#barraL").val(""),
      $("#ncodigo").val(""),
      $("#ndescripcion").val(""),
      $("#nlote").val(""),
      $("#nvencimiento").val(""),
      $("#npasillo").val(""),
      $("#nestante").val(""),
      $("#nstock").val(0),
      $("#ncantidad").val(""),
      $("#nubicacion").val(""),
      $("#ncosto").val("");
  }

  // Cargar inventario a realizar
  $("#btnCargarInventario").click(function (e) {
    e.preventDefault();
    let bodega = $("#bodega").val();
    let pasillo = $("#pasillo").val();
    let estanteI = $("#estanteInicial").val();
    let estanteF = $("#estanteFinal").val();

    const datosPos = {
      bodega: bodega,
      pasillo: pasillo,
      estanteInicial: estanteI,
      estanteFinal: estanteF,
    };

    console.log(datosPos);

    $.post("CargarInventario.php", datosPos, function (response) {
      if (response === "ok") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "INVENTARIO CARGADO!!",
          showConfirmButton: false,
          timer: 3000,
        });

        $("#inv").DataTable().ajax.reload(null, false);

        $("#bodega").val("");
        $("#pasillo").val("");
        $("#estanteInicial").val("");
        $("#estanteFinal").val("");
      }

      // editar = true;
    });
  });

  let listarIncosistencias = function () {
    var table = $("#inv").DataTable({
      dom: "frltip",
      responsive: true,
      lengthChange: false,
      // autoWidth: true,
      // buttons: ["excel", "pdf", "colvis"],

      ajax: {
        method: "POST",
        url: "listarInconsistenciasInv.php",
      },

      columns: [
        {
          defaultContent:
            '<div class="btn-group"><button class="btn btn-primary botonEditar data-toggle="modal" data-target="#modificarCantidadInco">Editar</button></div>',
        },
        { data: "alterno" },
        { data: "codigo" },
        { data: "lote" },
        { data: "stock" },
        { data: "cant_ingresada" },
        { data: "inconsistencia" },
        { data: "descripcion" },
        { data: "ubicacion" },
        { data: "ubicacion2" },
        { data: "pasillo" },
        { data: "estante" },
      ],

      createdRow: function (row, data, index) {
        if (data["inconsistencia"] < 0 && data["cant_ingresada"] != 0) {
          $("td", row).css({
            "background-color": "#f68f68",
            "text-align": "center",
            color: "black",
          });
        }
        if (data["inconsistencia"] > 0 && data["cant_ingresada"] != 0) {
          $("td", row).css({
            "background-color": "#f7ffa1",
            "text-align": "center",
          });
        }
      },
    });
    // .buttons()
    // .container()
    // .appendTo("#inv_wrapper .col-md-6:eq(0)");

    // obteneRegistro("#inv tbody", table);
  };

  listarIncosistencias();

  // $.post("listarInconsistenciasInv.php", function (response) {
  //   if (response === "0") {
  //     Swal.fire({
  //       position: "top-end",
  //       icon: "info",
  //       title: "Por favor cargue el inventario a Realizar",
  //       showConfirmButton: false,
  //       timer: 5000,
  //     });
  //   }

  //   // editar = true;
  // });

  $("#inv tbody").on("click", "button.botonEditar", function () {
    $("#modificarCantidadInco").modal("show");
    let data = $("#inv").DataTable().row($(this).parents("tr")).data();
    console.log(data);
    let idRegistro = $("#txtIdRegistroEdit").val(data.id);
    let alterno = $("#txtBarraEdit").val(data.alterno);
    let codigo = $("#txtCodigoEdit").val(data.codigo);
    let descripcion = $("#txtDescripcionEdit").val(data.descripcion);
    let lote = $("#txtLoteEdit").val(data.lote);
    let cantidad = $("#txtCantidadEdit").val(data.cant_ingresada);
  });

  $("#modificarRegistroinco").submit(function (e) {
    e.preventDefault();
    const $ventanaModal = $("#modificarCantidadInco");

    const datosEditar = {
      cantidad: parseInt($("#txtCantidadEdit").val()),
      id: $("#txtIdRegistroEdit").val(),
    };

    $.post("editarInconsistencias.php", datosEditar, function (response) {
      $("#inv").DataTable().ajax.reload(null, false);
      $ventanaModal.modal("hide");
    });
  });

  $("#btnActualizarInfo").click(function () {
    ValorInvSelectivo();
    refAInventariar();
    numInconsistencia();
    ValorRegistrado();
    numFaltantes();
    valorDiferencia();
    numItemsSobrantres();
  });

  // setTimeout(() => {
  //   numInconsistencia();
  //   ValorRegistrado();
  //   numFaltantes();
  //   valorDiferencia();
  //   numItemsSobrantres();
  // }, 2000);

  $("#btnActualizarIncons").click(function () {
    $("#inv").DataTable().ajax.reload(null, false);
  });

  $("#btnActualizarResumen").click(function () {
    listarRegistros();
  });

  $("#cerrarModalLote").click(function () {
    $("#modalSelecionarLote").modal("hide");
    limpiarFrmTomaInv();
    $("#buscarLote").val("");
  });

  $("#btnCerrarModalLote").click(function () {
    $("#modalCrearLote").modal("hide");
    limpiarFrmTomaInv();
    limpiarModalLotes();
    $("#buscarLote").val("");
  });
  //   Numero de inconsistencias
  function numInconsistencia() {
    $.ajax({
      url: "listarInconsistenciasInv.php",
      type: "GET",
      success: function (resp) {
        let reg = JSON.parse(resp);
        let num_inco = reg.data.length;
        $("#itemsInco").html(num_inco);
      },
    });
  }

  // Valor del inventario Selectivo

  function ValorInvSelectivo() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "valorInvSelectivo" },
      success: function (response) {
        let reg = JSON.parse(response);
        let vlrInvSel = reg[0]["valorInventario"];
        let vlorformateado = formato.format(vlrInvSel);
        $("#valorInvSelec").html(vlorformateado);
      },
    });
  }

  // valor del inventario registrado
  function ValorRegistrado() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "valorInvTomado" },
      success: function (response) {
        let reg = JSON.parse(response);
        let vlrTomado = reg[0]["valorTomado"];
        let vlrFormateado = formato.format(vlrTomado);
        $("#vlrTomado").html(vlrFormateado);
      },
    });
  }

  // diferencia en valor
  function valorDiferencia() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "valorDiferencia" },
      success: function (response) {
        let reg = JSON.parse(response);
        let vlrTomado = reg[0]["valorDiferencia"];
        let vlrFormateado = formato.format(vlrTomado);
        $("#vlrDiferencia").html(vlrFormateado);
        let box = document.querySelector("#boxDiferencia");

        if (vlrTomado < 0) {
          box.style.background = "red";
        }
        if (vlrTomado > 0) {
          box.style.background = "orange";
        }
        if (vlrTomado == 0) {
          box.style.background = "green";
        }
      },
    });
  }

  // Referencias a inventariar
  function refAInventariar() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "referenciasInv" },
      success: function (response) {
        let reg = JSON.parse(response);
        let numRef = reg[0]["referencias"];
        $("#refInv").html(numRef);
      },
    });
  }

  // items Sobrante
  function numItemsSobrantres() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "itemsSobrantes" },
      success: function (response) {
        let reg = JSON.parse(response);
        let itemS = reg.length;

        $("#itemSobrante").html(itemS);
      },
    });
  }

  // items falatantes
  function numFaltantes() {
    $.ajax({
      url: "generalidades.php",
      type: "GET",
      data: { funcion: "itemsFaltantes" },
      success: function (response) {
        let reg = JSON.parse(response);
        let itemF = reg.length;
        $("#itemsFaltante").html(itemF);
      },
    });
  }

  $("#btnLimpiarXlote").click(function () {
    $("#inPasillo").val("");
    $("#inEstante1").val("");
    $("#inEstante2").val("");
  });

  function desactivarInputFrmTomaInv() {
    document.getElementById("ubicacion").disabled = true;
    document.getElementById("barra").disabled = true;
  }

  function activarInputFrmTomaInv() {
    document.getElementById("ubicacion").disabled = false;
    document.getElementById("barra").disabled = false;
  }


    
    if (!$("#registroInventario input[name='area']:radio").is(":checked")) {
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "Debe Selecionar la zona de inventario picking u Original",
        showConfirmButton: false,
        timer: 4000,
      });
  
      desactivarInputFrmTomaInv();
  
  
    }
  


  let area = "";
  $("input[name=area]").click(function () {

    activarInputFrmTomaInv();
    area = $("input:radio[name=area]:checked").val();
    $("#ubicacion").val("");
    $("#ubicacion").focus();
  });

  $("#ubicacion").on("change", function () {
    area = $("input:radio[name=area]:checked").val();

    if (area !== "") {
      let localiza = $("#ubicacion").val();

      const datosLoc = {
        localiza: localiza,
        area: area,
      };
      $.post("validarExiteLocalizacion.php", datosLoc, function (resp) {
        if (resp == "ok") {
          area = $("input:radio[name=area]:checked").val();
          let localiTomada = "";

          if (area == "picking") {
            localiTomada = $("#ubicacion").val().slice(0, 4);
          }

          if (area == "originales") {
            localiTomada = $("#ubicacion").val();
          }

          const datosVal = {
            localiT: localiTomada,
          };

          $.post("validarLocalizacion.php", datosVal, function (response) {
            if (response > "0") {
              let reg = response;
              Swal.fire({
                position: "top-end",
                icon: "warning",
                title:
                  "Precaucion!!! esta Localizacion ya contiene " +
                  reg +
                  " Registros",
                showConfirmButton: false,
                timer: 5000,
              });
            }
          });
        } else {
          $("#ubicacion").val("");
          $("#ubicacion").focus();

          Swal.fire({
            position: "top-end",
            icon: "warning",
            title:
              "Precaucion!!! La localizacion no corresponde o no existe al area selecionada",
            showConfirmButton: false,
            timer: 4000,
          });
        }
      });
    }
  });
}); // fin del ready
