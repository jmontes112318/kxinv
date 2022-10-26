<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('location:../vista.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Kardex</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Inicia tu sesión</p>


                <div class="input-group mb-3">
                    <input type="text" id="txtUsuario" autocomplete="off" class="form-control" placeholder="Usuario">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="txtContrasenia" class="form-control" placeholder="Contrasenia">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <button id="btnLogin" class="btn btn-primary btn-block">Iniciar Sesion</button>
                    </div>
                    <!-- /.col -->
                </div>



                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../dist/css/sweetalert2.all.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="../js/usuario.js"></script>
</body>

</html>