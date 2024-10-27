<?php
session_set_cookie_params(0);
session_start();
include "../config/ruta.php";
require "../model/CategoriaModel.php";
require "../model/ProductoModel.php";
$producto = new Producto();
$categoria = new Categoria();
$ListaCategorias = $categoria->obtenerCategorias();
$ListaProductos = $producto->obtenerTodosLosProductos();

if (!$_SESSION['total_productos']) $_SESSION['total_productos'] = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CraftPlace - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./assets/images/icons/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="./vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="./vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="./vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="./vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="./vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="./vendor/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./vendor/MagnificPopup/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="./vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <?php include "menu_home.php" ?>

        <!-- Modal Search -->
        <?php include "modal_search.php" ?>
    </header>

    <!-- Cart -->
    <?php include "cart_lateral.php"; ?>

    <section class="section-slide">
    </section>


    <!-- Product -->
    <section class="bg0 p-t-140 p-b-140">
        <div class="container">
            <div class="row p-b-20">
                <h3 class="display-4 cl5">
                    Su compra se ha procesado con éxito.
                </h3>
            </div>
            <hr>


            <div class="row p-b-10">
                <div class="col-md-12">
                    <div class="block2-txt p-t-14">
                        <div class="block2-txt-child1 flex-col-l">
                            <span class="cl3 h3">
                                Gracias por preferirnos, su pedido le llegara a la dirección registada en su perfil.
                            </span>
                        </div>
                    </div>

                    <div class="block2-txt-child1 flex-col-l p-t-40">
                        <span class="mtext-110 cl3">
                            Dirección: <?= $_SESSION['direccion1'] ?> <?php if ($_SESSION['direccion2'] != null): echo ", " . $_SESSION['direccion2'];
                                                                        endif; ?>
                            <?= $_SESSION['ciudad'] . ", " . $_SESSION['municipio'] . ", " . $_SESSION['departamento'] ?>
                        </span>
                    </div>

                    <div class="block2-txt-child1 flex-col-l p-t-40">
                        <span class="mtext-110 cl3">
                        Tu pedido está siendo preparado. Recibirás una confirmación por correo electrónico con los detalles.
                        </span>
                    </div>


                </div>
            </div>

            <hr>

        </div>

    </section>


    <!-- Footer -->
    <?php include "footer_home.php" ?>

    <!-- Modal detalle de productos -->
    <?php include "modal_detalle.php" ?>


    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="./assets/js/slick-custom.js"></script>
    <script src="vendor/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <script src="./assets/js/main.js"></script>

    <!-- Modal Logout-->
    <?php include "modal_logout.php" ?>



</body>

</html>