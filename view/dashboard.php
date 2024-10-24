<?php
session_start();

// Establecer el tiempo límite de inactividad en segundos (30 minutos = 1800 segundos)
$inactividad = 1800;

// Comprobar si hay una variable de sesión que almacene el último acceso
if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];

    // Si el tiempo transcurrido es mayor al límite de inactividad, se destruye la sesión
    if ($tiempo_transcurrido > $inactividad) {
        // Destruir la sesión y redirigir al usuario (o mostrar mensaje)
        session_unset();     // Elimina las variables de sesión
        session_destroy();   // Destruye la sesión actual
        header("Location: logout.php");  // Redirigir al usuario
        exit();
    }
}

// Actualizar el tiempo del último acceso
$_SESSION['ultimo_acceso'] = time();



// Verificar si la sesión está activa (si hay una variable 'sesion_vendedor' establecida)
if (!isset($_SESSION['sesion_vendedor'])) {
    // Si la sesión no está activa, redirigir al login
    header("Location: login_vendedor.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Craftplace, venta de artesanias">
    <meta name="author" content="Grupo#">
    <title>Craftplace - Dashboard</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/menu-navbar.css" rel="stylesheet" type="text/css" />

    <!-- JQuery-3-3-1  for this template-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="vendor/jqueryui/jquery-ui.js" type="text/javascript"></script>


    <!--SweetAlert2-->
    <script src="vendor/sweetalert/sweetalert2.min.js" type="text/javascript"></script>
    <link href="vendor/sweetalert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Favicon-->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">


</head>


<body class="fixed-nav sticky-footer" id="page-top">

    <!-- Navigation-->
    <?php include "menu.php" ?>

    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <h5 class="card-title">Perfil</h5>
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa fa-users"></i>
                            </div>
                            <div class="mr-5">Ver el perfil</div>

                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Ver detalles</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <h5 class="card-title">Productos</h5>
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-cart-plus"></i>
                            </div>
                            <div class="mr-3">Ver detalle de productos
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="lista_producto.php">
                            <span class="float-left">Ver detalles</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <h5 class="card-title">Reportes</h5>
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-area-chart"></i>
                            </div>
                            <div class="mr-3">
                                Ver reportes de ventas y otros
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Ver detalles</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-dark o-hidden h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pagos y comisiones</h5>
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-calculator"></i>
                            </div>
                            <div class="mr-5">Ver el detalle de pagos y comisiones</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Ver detalles</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Otros card-->
            <div class="row">
                <div class="col-xl-8 col-sm-6 mb-3">
                </div>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-black bg-ligth o-hidden h-100">
                        <div class="card-body">
                            <h5 class="card-title">LINKS</h5>
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-external-link"></i>
                            </div>
                            <div class="mr-3">
                                <a href="/marketplace/" target="_blank">Tienda en linea</a><br />
                                <a href="lista_productos.php">Productos</a><br />
                                <a href="#">Clientes</a><br />
                                <a href="#">Reclamos</a><br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.content-wrapper-->

    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright© <a href="/marketplace" style="text-decoration: none;" target="_blank">CraftPlace</a> Desarrollado por Grupo#1 TPI115</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>


    <!-- Navigation-->
    <?php include "modal_logout.php" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->


</body>

</html>