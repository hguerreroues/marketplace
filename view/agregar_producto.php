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



// Verificar si la sesión está activa (si hay una variable 'vendedor_id' establecida)
if (!isset($_SESSION['sesion_vendedor'])) {
    // Si la sesión no está activa, redirigir al login
    header("Location: login_vendedor.php");
    exit();
}

include "../config/ruta.php";
require "../model/CategoriaModel.php";
$categorias = new Categoria();
$ListaCategorias = $categorias->obtenerCategorias();

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

            <div class="row p-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="../controller/ProductoController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" id="action" value="agregar">
                                <input type="hidden" name="idVendedor" id="idVendedor" value="<?=$_SESSION['id']?>">
                                <h4>Agregar Producto</h4>
                                <hr class="pb-3">
                                </mr>
                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nombreProducto">Nombre del producto *</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="email" placeholder="Nombre del Producto" required="">
                                            <small id="nombreProductoHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="descripcionProducto">Descripción del producto *</label>
                                            <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" placeholder="Descripcion del Producto" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidadProducto">Cantidad</label>
                                            <input type="text" class="form-control" id="cantidadProducto" name="cantidadProducto" placeholder="Cantidad" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pesoProducto">Peso</label>
                                            <input type="text" class="form-control" id="pesoProducto" name="pesoProducto" placeholder="Peso en libras" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precioNetoProducto">Precio Neto</label>
                                            <input type="text" class="form-control" id="precioNetoProducto" name="precioNetoProducto" placeholder="Precio Neto" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precioVentaProducto">Precio de venta</label>
                                            <input type="text" class="form-control" id="precioVentaProducto" name="precioVentaProducto" placeholder="Precio de venta" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categoriaProducto">Categoria</label>
                                            <select class="form-control" id="categoria" name="categoria" required="">
                                                <?php
                                                foreach ($ListaCategorias as $categoria): ?>
                                                    <option value="<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="porcentajeDescuento">Porcentaje de descuento</label>
                                            <input type="text" class="form-control" id="porcentajeDescuento" name="porcentajeDescuento" placeholder="Porcentaje de descuento (%)" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3 p-t-40 p-b-40">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agregarFoto">Agregar foto</label>
                                            <input type="file" class="form-control" id="agregarFoto" name="agregarFoto" required="" accept="image/jpeg, image/png">
                                            <small id="agregarFotoHelp" class="form-text text-muted">* Tamaño maximo permitido es de 5 MB,</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <label for="btnCancelar">&nbsp;</label>
                                        <a href="dashboard.php" class="btn btn-block btn-primary btn-lg">Salir</a>
                                    </div>
                                    <div class="col-md-3">
                                    <label for="btnSubmit">&nbsp;</label>
                                        <button type="submit"  class="btn btn-block btn-primary btn-lg">Guardar</button>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <!-- Div para mostrar la respuesta (alert) -->
                                    <?php
                                    if (isset($_SESSION['mensaje_error'])): ?>
                                        <div class="col-12 text-center">
                                            <div class="alert alert-danger m-t-18 w-100" role="alert">
                                                <?= $_SESSION['mensaje_error'] ?>
                                            </div>
                                        </div>
                                    <?php endif;
                                    unset($_SESSION['mensaje_error']);
                                    ?>
                                </div>


                            </form>
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




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->


</body>

</html>