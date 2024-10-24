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
require "../model/ProductoModel.php";
$producto = new Producto();
$categoria = new Categoria();
$ListaCategorias = $categoria->obtenerCategorias();
$ListaProductos = $producto->obtenerProductosPorVendedor($_SESSION['id']);

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
                            <div class="row mt-2 mb-3">
                                <div class="col-lg-9">
                                    <h4>Lista de productos</h4>
                                </div>
                                <div class="col-lg-3"><a href="agregar_producto.php" class="btn btn-primary btn-block">Agregar Producto</a></div>
                            </div>
                            <div class="table-responsive">
                                <div class="table" id="container">
                                    <table class="table table-bordered table-hover table-sm nowrap" id="dataTable" width="100%" cellspacing="0" name="datos">
                                        <!--table class="features-table" id="datos"-->
                                        <thead class="thead-dark">
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Detalles</th>
                                                <th>Categoria</th>
                                                <th>Descuento (%)</th>
                                                <th>Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($ListaProductos as $producto):
                                                foreach ($ListaCategorias as $categoria):
                                                    if ($producto['id_categoria'] == $categoria['id']) {
                                                        $producto['id_categoria'] = $categoria['nombre'];
                                                    }
                                                endforeach; ?>
                                                <tr>
                                                    <td class="text-center"><?= $producto['id']; ?></td>
                                                    <td class="pl-3"><?= $producto['nombre']; ?></td>
                                                    <td class="pl-3"><?= $producto['descripcion']; ?></td>
                                                    <td class="pl-3">
                                                        Cantidad: <?= $producto['cantidad']; ?><br/>
                                                        Peso: <?= $producto['peso']; ?><br/>
                                                        Precio Neto: <?= $producto['precio_neto']; ?><br/>
                                                        Precio Venta: <?= $producto['precio_lista']; ?>
                                                    </td>
                                                    <td class="text-center"><?= $producto['id_categoria']; ?></td>
                                                    <td class="text-right pr-3"><?= $producto['descuento']; ?></td>
                                                    <!-- <td class="text-center pr-3"><img src="../view/assets/images/tetera-china.jpg" alt="<?= $producto['nombre']; ?>" style="height: 240px;"></td> -->
                                                    <td class="text-center pr-3"><img src="<?= $producto['url_imagen']; ?>" alt="<?= $producto['nombre']; ?>" class="img-thumbnail"></td>
                                                <?php endforeach; ?>



                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
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




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->


</body>

</html>