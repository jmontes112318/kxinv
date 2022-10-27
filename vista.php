<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('location:login/login.php');
}

?>
<!DOCTYPE html>

<html lang="es">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kardex</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="fontawesome-free/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="dist/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="dist/css/sweetalert2.min.css">
  <!-- DataTables -->

  <link rel="stylesheet" href="dist/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/datatables/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="dist/datatables/SearchPanes-2.0.2/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" href="dist/datatables/Select-1.4.0/css/select.dataTables.min.css"> -->




  <link rel="stylesheet" href="css/style.css">






  <script src="js/jquery-3.6.0.min.js"></script>
  
</head>

<body class="hold-transition layout-top-nav ">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="#" class="navbar-brand">
          <span class="brand-text font-weight-light">Toma Inventario</span>
        </a>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/usuario/default/anonymous.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
            </a>

            <ul class="dropdown-menu">

              <li class="user-body">

                <div class="pull-right">
                  <a href="cerrarSesion.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>


      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Toma de inventario <small>Kardex</small></h1>
            </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Toma Inv</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Resumen</a>
              </li>

              <?php
              if ($_SESSION['perfil'] == 'Administrador' ||  $_SESSION['perfil'] == 'Auditor') {
                echo
                '
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Gestion de Inventario</a>
                  </li>
                  
                  
                  ';
              }

              ?>


              <?php
              if ($_SESSION['perfil'] == 'Administrador' ||  $_SESSION['perfil'] == 'Auditor') {
                echo
                '
                      
                      <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-inventario-tab" data-toggle="pill" href="#custom-content-below-inventario" role="tab" aria-controls="custom-content-below-inventario" aria-selected="false">Inventario</a>
                      </li>
                      
                      
                      ';
              }

              ?>

              <?php
              if ($_SESSION['perfil'] == 'Administrador') {
                echo
                '
                      
                      <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-usuario-tab" data-toggle="pill" href="#custom-content-below-usuario" role="tab" aria-controls="custom-content-below-usuario" aria-selected="false">Gestion Usuarios</a>
                      </li>
                      
                      
                      ';
              }

              ?>

              <?php
              if ($_SESSION['perfil'] == 'Administrador' ||  $_SESSION['perfil'] == 'Auditor') {
                echo
                '
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-informacionInv-tab" data-toggle="pill" href="#custom-content-below-informacionInv" role="tab" aria-controls="custom-content-below-informacionInv" aria-selected="false">Generalidades</a>
                  </li>
                  
                  
                  ';
              }

              ?>

              <?php
              if ($_SESSION['perfil'] == 'Administrador' ||  $_SESSION['perfil'] == 'Auditor') {
                echo
                '
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-reporte-tab" data-toggle="pill" href="#custom-content-below-reporte" role="tab" aria-controls="custom-content-below-reporte" aria-selected="false">Reportes</a>
                  </li>
                  
                  
                  ';
              }

              ?>


            </ul>





            <div class="tab-content" id="custom-content-below-tabContent">

              <!-- Formulario registro -->

              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Registro Productos</h3>
                  </div>
                  <form id="registroInventario">
                    <!-- <input type="hidden" id="idRegistro" /> -->
                    <div class="card-body" style="width:100%">

                      <div class="row">

                        <div class="col-6">
                          <div class="form-group">
                            <input type="text" class="form-control" id="txtPerfil" name="txtPerfil" value="<?php echo $_SESSION["perfil"] ?>" disabled hidden />
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <!-- <label for="usuario">Usuario</label> -->
                            <input type="text" class="form-control" id="usuario" value="<?php echo $_SESSION["usuario"] ?>" name="usuario" disabled hidden />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class=" col-xs-12 col-md-4 col-lg-4  ">
                          <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              <input type="radio" id="rbPicking" value="picking" name="area">
                              <label for="rbPicking">
                                Picking
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class=" col-xs-12 col-md-4 col-lg-4  ">
                          <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                              <input type="radio" id="rbOriginales" value="originales" name="area">
                              <label for="rbOriginales">
                                Originales
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-xs-12 ">
                          <div class="form-group">
                            <label for="ubicacion">Localizacion</label>
                            <input type="text" class="form-control" id="ubicacion" autocomplete="off" name="ubicacion" placeholder="Localizacion" required />
                          </div>
                        </div>
                      </div>



                      <div class="row">
                        <div id="camara"></div>
                        <div class="col-lg-5 col-xs-12">
                          <div class="form-group">
                            <label for="barra">Codigo Barra</label>
                            <input type="search" class="form-control barra" autocomplete="off" id="barra" name="barra" placeholder="Codigo Barra" />
                          </div>
                        </div>
                        <div class="col-lg-6 col-xs-5">
                          <div class="form-group">
                            <label for="reflote">lote</label>
                            <input type="text" class="form-control" id="reflote" name="reflote" disabled />
                          </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                          <div class="form-group" hidden>
                            <a class="crear_lote" href="#" hidden>Crear Lote</a>
                          </div>
                        </div>


                      </div>

                      <div class="row">
                        <div class="col-lg-4 col-xs-7">
                          <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" />
                          </div>
                        </div>
                        <!-- <div class="col-lg-2">
                          <div class="form-group">
                            <label for="cantidad">alerta</label>
                            <input type="text" class="form-control" id="alerta" name="alerta" hidden disabled />
                          </div>
                        </div> -->



                      </div>

                      <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" autocomplete="off" name="descripcion" placeholder="Descripcion" disabled />
                      </div>


                      <div class="row">
                        <div class="col-lg-5 col-xs-12  col-md-5">
                          <div class="form-group">
                            <label for="condigoInterno">Codigo</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" disabled />
                          </div>
                        </div>



                        <div class="col-lg-5 col-xs-12 col-md-5">
                          <div class="form-group">
                            <!-- <label for="idlote">id-lote</label> -->
                            <input type="text" class="form-control" id="idlote" name="idlote" disabled hidden />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4 col-xs-12">
                          <div class="form-group">

                            <input type="text" class="form-control" id="pasilloR" name="pasilloR" disabled hidden />
                          </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">

                          <div class="form-group">

                            <input type="text" class="form-control" id="estanteR" name="estanteR" disabled hidden />
                          </div>
                        </div>


                        <div class="col-lg-4 col-xs-12">

                          <div class="form-group">

                            <input type="number" class="form-control" id="costoR" name="costoR" disabled />
                            <input type="text" class="form-control" id="ubicacionP" name="ubicacionP" disabled hidden />

                          </div>
                        </div>
                      </div>


                      <!-- /.card-body -->

                      <div class="card-footer">

                        <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-primary">
                            Guardar
                          </button>

                          <button type="button" class="btn btn-warning" id="btnlimpiar">
                            limpiar
                          </button>

                        </div>


                      </div>
                  </form>
                </div>
              </div>


              <!-- Modal tabla  Lote-->

              <div id="modalSelecionarLote" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" style="background:#3c8dbc; color:white">
                      <button type="button" id="cerrarModalLote">&times;</button>

                      <h4 class="modal-title">Seleccionar lote</h4>

                    </div>
                    <div class="modal-body">

                      <div class="card ">
                        <div class="card-header">
                          <a class="crear_lote" href="#" hidden>Crear Lote</a>
                          <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                              <input type="text" id="buscarLote" name="buscarLote" class="form-control float-right bslote" placeholder="Search">
                            </div>
                          </div>
                        </div>
                        <div class="card-body table-responsive">
                          <table class="table  table-responsive table-head-fixed text-nowrap" id="tblLotes">
                            <thead>
                              <tr>

                                <th>Lote</th>
                                <th>Vencimiento</th>

                              </tr>
                            </thead>
                            <tbody id="selecLote">

                            </tbody>
                          </table>
                        </div>


                      </div> <!--  fin del card -->



                    </div>
                    <div class="modal-footer">

                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- fin formulario de registro -->


            <!--- ------------------------------------------------------------------------------------ -->
            <!-- ------------------------------TABLA RESUMEN------------------------------------------ -->
            <!-- ------------------------------------------------------------------------------------- -->


            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Actrualizar Registros
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-9">
                      <button class="btn btn-info" id="btnActualizarResumen">Actualizar Registros</button>
                    </div>

                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title">Productos Ingresados</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" id="buscar" name="buscar" class="form-control float-right" placeholder="Search">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                      <div class="table-responsive">
                        <table class="table  table-head-fixed text-nowrap" id="resumen">
                          <thead>
                            <tr>
                              <th>Usuario</th>
                              <th>Codigo</th>
                              <th>Lote</th>
                              <th>cantidad</th>
                              <th>descripcion</th>
                              <th>alterno</th>
                              <th>Ubicacion_tomada</th>
                              <th>conteo</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody id="tblResumen">

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->

              <div class="modal fade" id="modificarCantidad">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Editar Cantidad Ingresada</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="modificarRegistro">
                        <input type="hidden" id="eidRegistro" />
                        <div class="card-body">
                          <div class="row">
                            <div class="col-5">
                              <div class="form-group">
                                <label for="eubicacion">Ubicacion</label>
                                <input type="text" class="form-control" id="eubicacion" name="eubicacion" disabled />
                              </div>
                            </div>

                            <div class="col-7">
                              <div class="form-group">
                                <label for="eusuario">Usuario</label>
                                <input type="text" class="form-control" id="eusuario" name="eusuario" disabled />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-8">
                              <div class="form-group">
                                <label for="ebarra">Codigo Barra</label>
                                <input type="search" class="form-control barra" autocomplete="off" id="ebarra" name="ebarra" placeholder="Codigo Barra" disabled />
                              </div>
                            </div>

                            <div class="col-4">
                              <div class="form-group">

                                <label for="ecodigo">Codigo</label>
                                <input type="text" class="form-control" id="ecodigo" name="ecodigo" placeholder="Codigo" disabled />
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="edescripcion">Descripcion</label>
                            <input type="text" class="form-control" id="edescripcion" name="edescripcion" placeholder="Descripcion" disabled />
                          </div>
                          <div class="row">
                            <div class="col-7 col-sm-7">
                              <div class="form-group">
                                <label>Lote</label>
                                <input type="text" class="form-control" id="ereflote" name="ereflote" disabled />

                              </div>
                            </div>
                            <div class="col-5 col-sm-5">



                              <div class="form-group">
                                <label for="eidlote">id-lote</label>
                                <input type="number" class="form-control" id="eidlote" name="eidlote" disabled hidden />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-7">
                              <div class="form-group">
                                <label for="ecantidad">Cantidad</label>
                                <input type="number" class="form-control" id="ecantidad" name="ecantidad" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="form-group">
                                <label for="ealerta">alerta</label>
                                <input type="text" class="form-control" id="ealerta" name="ealerta" hidden disabled />
                              </div>
                            </div>


                          </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">



                          <button type="submit" class="btn btn-primary">
                            Modificar
                          </button>

                          <!-- <button type="button" class="btn btn-warning" id="btnlimpiar">
                              limpiar
                            </button> -->
                        </div>
                      </form>

                    </div>
                    <!-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Modificar</button>
                      </div> -->
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

            </div>

            <!-- FIN TABLA RESUMEN -->

            <!-- ------------------------------------------------------------------------------------- -->
            <!-- ------------------------------Gestion para Inv------------------------------- -->
            <!-- ------------------------------------------------------------------------------------- -->


            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Inventario
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="#" id="cargarInventario">
                    <div class="row">

                      <div class=" form-group col-lg-3 input-group mb-2 input-group-mb">
                        <span class="input-group-text">Bodega:</span>
                        <input type="text" class="form-control" id="bodega" placeholder="Bod" autocomplete="off">
                      </div>

                      <div class=" form-group col-lg-3 input-group mb-2 input-group-mb">
                        <span class="input-group-text">Pasillo:</span>
                        <input type="text" class="form-control" id="pasillo" placeholder="Pasillo" autocomplete="off">
                      </div>

                      <div class=" form-group  col-lg-3 input-group mb-2 input-group-mb">
                        <span class="input-group-text">Desde:</span>
                        <input type="text" id="estanteInicial" class="form-control" placeholder="Estante" autocomplete="off">
                      </div>

                      <div class=" form-group  col-lg-3 input-group mb-2 input-group-mb">
                        <span class="input-group-text">Hasta:</span>
                        <input type="text" class="form-control" id="estanteFinal" placeholder="Estante" autocomplete="off">
                      </div>

                      <div class=" col-lg-3 ">
                        <button id="btnCargarInventario" class="btn btn-secondary">Cargar Inventario</button>
                      </div>
                    </div>
                  </form>
                  <br><br>



                </div>


              </div>



            </div>

            <!-- FIN TABLA INVENTARIO GENERAL -->

            <!-- ------------------------------------------------------------------------------------- -->
            <!-- ---------------------------------CREAR LOTES----------------------------------------- -->
            <!-- ------------------------------------------------------------------------------------- -->


            <div id="modalCrearLote" class="modal fade" role="dialog">

              <div class="modal-dialog">

                <div class="modal-content">

                  <form id="crearLote">

                    <!--=====================================
                        CABEZA DEL MODAL
                        ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                      <!-- <button type="button" id="cerrarModalLote">&times;</button> -->

                      <h4 class="modal-title">Crear Lote</h4>

                    </div>

                    <!--======= FINCABEZA DEL MODAL====-->

                    <!--=====================================
                        CUERPO DEL MODAL
                        ======================================-->


                    <div class="modal-body">

                      <div class="box-body">

                        <!--====// barra //=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" class="form-control barraL" id="barraL" name="barraL" placeholder="Codigo Barra" disabled />
                          </div> <!-- fin div input-group -->
                        </div> <!-- fin div form-group -->

                        <!--====// codigo//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" class="form-control" id="ncodigo" name="ncodigo" placeholder="Codigo" disabled />
                          </div>

                        </div>

                        <!--====//descripcion//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" class="form-control" id="ndescripcion" name="ndescripcion" placeholder="Descripcion" disabled />
                          </div>
                        </div>

                        <!--====// Entrada Para Lote//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" class="form-control bslote" id="nlote" name="nlote" placeholder="Ingrese Lote" required />
                          </div>
                        </div>

                        <!--====// Entrada Para Vencimiento//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="date" class="form-control" id="nvencimiento" name="nvencimiento" placeholder="Vencimiento" required />
                          </div>
                        </div>

                        <!--====// Entrada Para cantiddad//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="number" class="form-control" id="ncantidad" min="1" name="ncantidad" placeholder="Cantidad" required />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <input type="number" class="form-control" id="nstock" name="nstock" value="0" hidden />
                            <input type="text" class="form-control" id="nubicacion" name="nubicacion" hidden />
                            <input type="number" class="form-control" id="ncosto" name="ncosto" hidden />
                            <input type="text" class="form-control" id="npasillo" name="npasillo" hidden />
                            <input type="text" class="form-control" id="nestante" name="nestante" hidden />

                          </div>
                        </div>

                      </div> <!-- fin div box-body -->
                    </div>
                    <!--fin div modal-body -->

                    <!--=====================================
                        PIE DEL MODAL
                      ======================================-->

                    <div class="modal-footer">

                      <button type="button" id="btnCerrarModalLote" class="btn btn-default pull-left">Salir</button>

                      <button type="submit" id="btnCrearLote" name="btnCrearLote" disabled class="btn btn-primary">Crear Lote</button>
                    </div>



                  </form>


                </div> <!-- fin modal-content -->
              </div> <!-- fin modal-dialog -->
            </div>

            <!-- FIN CREAR LOTES -->



            <!-- ------------------------------------------------------------------------------------- -->
            <!-- ----------------------------------TABLA INVENTARIO----------------------------------- -->
            <!-- ------------------------------------------------------------------------------------- -->

            <div class="tab-pane fade" id="custom-content-below-inventario" role="tabpanel" aria-labelledby="custom-content-below-inventario-tab">

              <div class="row my-3">

                <div class=" col-xs-12 col-md-8 col-lg-8 ">
                  <button id="btnActualizarIncons" class="btn btn-info">Actualizar Inconsistencias</button>
                </div>
              </div>



              <div class="row">
                <div class="col-xs-12 col-md-12  col-lg-12">
                  <div class="table-responsive">
                    <table id="inv" class="table table-bordered table-striped ">
                      <thead>
                        <tr>
                          <th>Editar</th>
                          <th>Alterno</th>
                          <th>Codigo</th>
                          <th>Lote</th>
                          <th>stock</th>
                          <th>ingresado</th>
                          <th>diferencia</th>
                          <th>Descripcion</th>
                          <th>ubicacion</th>
                          <th>ubicacion2</th>
                          <th>pasillo</th>
                          <th>estante</th>
                        </tr>
                      </thead>

                    </table>
                  </div>




                </div>


              </div> <!-- /.row -->
            </div>

            <!-- FIN TABLA INVENTARIO -->

            <!-- Modal modificar inconsistencias  -->

            <div class="modal fade" id="modificarCantidadInco">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Editar Cantidad Ingresada</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="modificarRegistroinco">
                      <input type="hidden" id="txtIdRegistroEdit" />
                      <div class="card-body">

                        <div class="row">
                          <div class="col-7">
                            <div class="form-group">
                              <label for="txtBarraEdit">Codigo Barra</label>
                              <input type="search" class="form-control" autocomplete="off" id="txtBarraEdit" name="txtBarraEdit" disabled />
                            </div>
                          </div>

                          <div class="col-5">
                            <div class="form-group">
                              <label for="txtCodigoEdit">codigo</label>
                              <input type="text" class="form-control" id="txtCodigoEdit" name="txtCodigoEdit" disabled />
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="txtDescripcionEdit">Descripcion</label>
                              <input type="text" class="form-control" id="txtDescripcionEdit" name="txtDescripcionEdit" placeholder="Descripcion" disabled />
                            </div>
                          </div>


                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label for="txtLoteEdit">lote</label>
                              <input type="text" class="form-control" id="txtLoteEdit" name="txtLoteEdit" disabled />
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <label for="txtCantidadEdit">Cantidad</label>
                              <input type="number" class="form-control" id="txtCantidadEdit" min="0" name="txtCantidadEdit" />
                            </div>
                          </div>



                        </div>



                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">


                        <button type="submit" id="btnModificarInco" class="btn btn-primary">
                          Modificar
                        </button>

                        <!-- <button type="button" class="btn btn-warning" id="btnlimpiar">
                                limpiar
                              </button> -->
                      </div>
                    </form>

                  </div>
                  <!-- <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Modificar</button>
                        </div> -->
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal  modificar inconsistencias -->


            <!-- ------------------------------------------------------------------------------------- -->
            <!-- ----------------------------------UsuarioS------------------------------------------- -->
            <!-- ------------------------------------------------------------------------------------- -->


            <div class="tab-pane fade" id="custom-content-below-usuario" role="tabpanel" aria-labelledby="custom-content-below-usuario-tab">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Gestion de Usuarios
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class=" col-lg-3 ">
                      <button id="btnCargarInventario" data-toggle="modal" data-target="#modalAgregarUsuario" class="btn btn-secondary">Registrar Usuario</button>
                    </div>
                  </div>


                </div>
              </div>



              <div class="row">

                <div class="card card-success" style="width:100%">

                  <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                  </div> <!-- /.card-header -->

                  <div class="card-body table-responsive">
                    <table id="tblUsuarios" class="table table-bordered table-striped dt-responsive" style="width:100%">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Perfil</th>
                          <th>Contraseña</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>

                    </table>
                  </div> <!-- /.card-body -->
                </div><!-- /.card- success -->

              </div> <!-- /.row -->

            </div>

            <!-- Fin Usuario  -->

            <!-- Modal Registro Usuario  -->

            <div id="modalAgregarUsuario" class="modal fade" role="dialog">

              <div class="modal-dialog">

                <div class="modal-content">

                  <form id="frmAgregarUsuario">

                    <!--=====================================
                        CABEZA DEL MODAL
                        ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->

                      <h4 class="modal-title">Agregar usuario</h4>

                    </div>

                    <!--======= FINCABEZA DEL MODAL====-->

                    <!--=====================================
                        CUERPO DEL MODAL
                        ======================================-->


                    <div class="modal-body">

                      <div class="box-body">

                        <!--====//Entrada para nombre//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <input type="text" class="form-control input-lg" id="agrNombre" autocomplete="off" name="agrNombre" placeholder="Ingresar nombre" required>
                          </div> <!-- fin div input-group -->
                        </div> <!-- fin div form-group -->

                        <!--====//Entrada para usuario//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <input type="text" class="form-control input-lg" id="agrUsuario" autocomplete="off" name="agrUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
                          </div>

                        </div>

                        <!--====//Entrada para Contraseña//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <input type="password" class="form-control input-lg" id="agrPassword" name="agrPassword" placeholder="Ingresar contraseña" required>
                          </div>
                        </div>

                        <!--====//Entrada para Perfil//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <select class="form-control input-lg" id="agrPerfil" name="agrPerfil">
                              <option value="">Selecionar perfil</option>
                              <option value="Administrador">Administrador</option>
                              <option value="Auditor">Auditor</option>
                              <option value="Digitador">Digitador</option>
                            </select>
                          </div>
                        </div>

                      </div> <!-- fin div box-body -->
                    </div>
                    <!--fin div modal-body -->

                    <!--=====================================
                        PIE DEL MODAL
                      ======================================-->

                    <div class="modal-footer">

                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                      <button type="submit" id="btnAgregarUsuario" name="btnAgregarUsuario" class="btn btn-primary">Guardar usuario</button>
                    </div>



                  </form>


                </div> <!-- fin modal-content -->
              </div> <!-- fin modal-dialog -->
            </div>


            <!-- /.modal registro usuario-->


            <!-------------------------------- -->
            <!-------------------------------- -->
            <!-------------------------------- -->


            <!-- Modal Edita Usuario  -->

            <div id="modaEditarUsuario" class="modal fade" role="dialog">

              <div class="modal-dialog">

                <div class="modal-content">

                  <form id="frmEditarUsuario">

                    <!--=====================================
                          CABEZA DEL MODAL
                        ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->

                      <h4 class="modal-title">Agregar usuario</h4>

                    </div>

                    <!--======= FINCABEZA DEL MODAL====-->

                    <!--=====================================
                          CUERPO DEL MODAL
                          ======================================-->


                    <div class="modal-body">

                      <div class="box-body">

                        <!--====//Entrada para nombre//=====-->

                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" id="editIdusuario" hidden>
                            <input type="text" class="form-control input-lg" id="editNombre" autocomplete="off" name="editNombre" placeholder="Ingresar nombre" required>
                          </div> <!-- fin div input-group -->
                        </div> <!-- fin div form-group -->

                        <!--====//Entrada para usuario//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <input type="text" class="form-control input-lg" id="editUsuario" autocomplete="off" name="editUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
                          </div>

                        </div>

                        <!--====//Entrada para Contraseña//=====-->



                        <div class="form-group">
                          <div class="input-group">
                            <input type="password" class="form-control input-lg" id="editPassword" name="editPassword" placeholder="Ingresar contraseña" required>
                          </div>
                        </div>





                        <!--====//Entrada para Perfil//=====-->

                        <div class="form-group">
                          <div class="input-group">

                            <select class="form-control input-lg" id="editPerfil" name="editPerfil">
                              <option value="">Selecionar perfil</option>
                              <option value="Administrador">Administrador</option>
                              <option value="Auditor">Auditor</option>
                              <option value="Digitador">Digitador</option>
                            </select>
                          </div>
                        </div>

                      </div> <!-- fin div box-body -->
                    </div>
                    <!--fin div modal-body -->

                    <!--=====================================
                          PIE DEL MODAL
                        ======================================-->

                    <div class="modal-footer">

                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                      <button type="submit" id="btnEditarUsuario" name="btnEditarUsuario" class="btn btn-primary">Guardar usuario</button>
                    </div>



                  </form>


                </div> <!-- fin modal-content -->
              </div> <!-- fin modal-dialog -->
            </div> <!-- fin idmodalAgregarusuario -->


            <!-- /.modal editar usuario-->


            <!-- ------------------------------------------------------------------------------------- -->
            <!-- -----------------------------INFORMACION DE INVENTARIO-------------------------------- -->
            <!-- ------------------------------------------------------------------------------------- -->

            <div class="tab-pane fade" id="custom-content-below-informacionInv" role="tabpanel" aria-labelledby="custom-content-below-informacionInv-tab">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Generalidades
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-9">
                      <button class="btn btn-info" id="btnActualizarInfo">Actualizar Informacion</button>
                    </div>

                  </div>
                  <br><br>

                  <!-- Small boxes superior  (Stat box) -->
                  <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box  bg-success">
                        <div class="inner">
                          <h4 id="valorInvSelec"></h4>

                          <p>Valor ($) Inv Selectivo</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h4 id="vlrTomado"></sup></h4>

                          <p>Valor Registrado</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box " id="boxDiferencia">
                        <div class="inner">
                          <h4 id="vlrDiferencia"></h4>

                          <p>Valor ($) Diferencia </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h4></h4>

                          <p># items Sobrantes</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->



                  <!-- Small boxes inferior (Stat box) -->
                  <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h4 id="refInv"></h4>

                          <p># Items a inventariar </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-add"></i>
                        </div>

                      </div>


                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h4 id="itemsFaltante"></h4>

                          <p>$ items Faltantes</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->


                      <div class="small-box bg-info">
                        <div class="inner">
                          <h4 id="itemSobrante"></h4>

                          <p># items Sobrantes</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>

                      </div>








                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h4 id="itemsInco"></h4>

                          <p># items Con inconsisencias</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>

                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->






                </div>
              </div>




            </div>


            <!-- ------------------------------------------------------------------------------------- -->
            <!-- -----------------------------Reportes------------------------------------------------ -->
            <!-- ------------------------------------------------------------------------------------- -->

            <div class="tab-pane fade" id="custom-content-below-reporte" role="tabpanel" aria-labelledby="custom-content-below-reporte-tab">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Reportes
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">

                    <div class="col-lg-6">

                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h5 class="card-title m-0">Inconsistencias por Lote</h5>
                        </div>
                        <div class="card-body">
                          <form id="frmInconsistencias" action="http://localhost:8080/kxinv/reporteInconsistencias.php" target="_blank" method="POST" autocomplete="off">

                            <div class="row">
                              <div class="form-group col-lg-4">
                                <label for="inPasillo"></label>
                                <input type="text" class="form-control" name="inPasillo" id="inPasillo" autocomplete="off">
                                <small class="form-text text-muted">Pasillo</small>
                              </div>


                              <div class="form-group col-lg-4">
                                <label for="inEstante1"></label>
                                <input type="text" class="form-control" name="inEstante1" id="inEstante1" autocomplete="off">
                                <small class="form-text text-muted">1er_Estante</small>
                              </div>

                              <div class="form-group col-lg-4">
                                <label for="inEstante2"></label>
                                <input type="text" class="form-control" name="inEstante2" id="inEstante2" autocomplete="off">
                                <small class="form-text text-muted">(n)_Estante</small>
                              </div>


                            </div>
                            <button type="submit" class="btn btn-outline-primary">Imprimir</button>
                            <button type="button" id="btnLimpiarXlote" class="btn btn-outline-warning fa-pull-right">limpiar</button>


                          </form>




                        </div>
                      </div>

                      <div class="card card-danger card-outline">
                        <div class="card-header">
                          <h5 class="card-title m-0">Faltantes por Lote</h5>
                        </div>
                        <div class="card-body">
                          <form action="http://localhost:8080/kxinv/reporteFaltantes.php" target="_blank" autocomplete="off" method="post">
                            <p class="card-text">Productos para realizar ajuste de Salida, lote faltante Vs inv fisico o producto faltante</p>
                            <button type="submit" class="btn btn-outline-danger">Imprimir Faltantes</button>
                          </form>



                        </div>
                      </div>
                    </div>


                    <div class="col-lg-6">

                      <div class="card card-warning card-outline">
                        <div class="card-header">
                          <h5 class="card-title m-0">Sobrantes por Lote</h5>
                        </div>
                        <div class="card-body">
                          <form action="http://localhost:8080/kxinv/reporteSobrantes.php" target="_blank" autocomplete="off" method="post">
                            <p class="card-text">Productos para realizar ajuste de Entrada, lote sobrante Vs stock en el sistema o producto sobrante</p>
                            <button type="submit" class="btn btn-outline-warning">Imprimir Sobrantes</button>
                          </form>

                        </div>
                      </div>

                      <div class="card card-success card-outline">
                        <div class="card-header">
                          <h5 class="card-title m-0">Inconsistencias X Cantidad</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <form action="http://localhost:8080/kxinv/reporteIncoXcantidadSobr.php" target="_blank" autocomplete="off" method="post">
                                <p class="card-text">Productos Sobrante</p>
                                <button type="submit" class="btn btn-outline-primary">Imprimir Sobrantes</button>
                              </form>

                            </div>
                            <div class="col-lg-6">

                              <form action="http://localhost:8080/kxinv/reporteIncoXcantidadFalt.php" target="_blank" autocomplete="off" method="post">
                                <p class="card-text">Productos Faltante</p>
                                <button type="submit" class="btn btn-outline-danger">Imprimir faltantes</button>
                              </form>


                            </div>


                          </div>



                        </div>
                      </div>
                    </div>


                  </div>


                </div>
              </div>
              <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
          </aside>
          <!-- /.control-sidebar -->

          <!-- Main Footer -->
          <footer class="main-footer">

            <strong>jmontes &copy; 2022 </strong>

          </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <script src="js/app.js"></script>

        <!-- Bootstrap 4 -->
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="dist/js/demo.js"></script> -->

        <!-- SweetAlert2 -->
        <script src="dist/css/sweetalert2.all.min.js"></script>
        <!-- DataTables  & Plugins -->
        <!-- jQuery -->

        <script src="dist/Data_Tables/datatables.js"></script>
        <script src="datatables/jquery.dataTables.min.js"></script>


        <script src="dist/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- <script src="dist/datatables/SearchPanes-2.0.2/js/dataTables.searchPanes.min.js"></script>
        <script src="dist/datatables/Select-1.4.0/js/dataTables.select.min.js"></script> -->


        <!-- Para usar los botones -->
        <script src="dist/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="dist/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="dist/datatables/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="dist/datatables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="dist/datatables/jszip/jszip.min.js"></script>
        <script src="dist/datatables/pdfmake/pdfmake.min.js"></script>
        <script src="dist/datatables/pdfmake/vfs_fonts.js"></script>
        <script src="dist/datatables/pdfmake/vfs_fonts.js"></script>

        <!-- <script src="dist/datatables/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="dist/datatables/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="dist/datatables/datatables-buttons/js/buttons.colVis.min.js"></script> -->



        <script src="js/usuario.js"></script>



</body>

</html>