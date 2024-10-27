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
if(!$_SESSION['carrito']) {
    header("Location: ../view/home.php");
}

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
            <div class="p-b-20">
                <h3 class="ltext-85 cl5">
                    Detalle de productos
                </h3>
            </div>

            <?php
            $totalProducto = 0;
            if (!empty($_SESSION['carrito'])):
                foreach ($_SESSION['carrito'] as $producto): 
                     $totalProducto += (int) $producto['cantidad'] * (float) str_replace('$', '', $producto['precio']);
                ?>
                    <div class="row p-b-10">

                        <div class="col-3">

                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic flex-w flex-r">
                                    <img src="<?= $producto['url'] ?>" alt="<?= $producto['nombre'] ?>" style="width: 100px">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">

                            <div class="block2-txt flex-w flex-r p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="#" class="mtext-110 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?= $producto['nombre'] ?>
                                    </a>

                                    <span class="mtext-110 cl3">
                                        <?= $producto['cantidad'] ?> x <?= $producto['precio'] ?>
                                    </span>
                                </div>


                            </div>
                        </div>

                        <div class="col-4">
                            <div class="block2-txt flex-w flex-r p-t-14 p-r-24 p-b-18">
                                <span class="mtext-110 cl3 p-l-10">
                                    <?= '$' . number_format((int) $producto['cantidad'] * (float) str_replace('$', '', $producto['precio']), 2) ?>
                                </span>
                            </div>
                            <div class="block2-txt flex-w flex-r p-t-3 text-center">
                                <a href="../controller/ProductoController.php?action=eliminarCarrito&id=<?= $producto['id'] ?>" class="flex-c-m stext-101 cl5 size-103 btn-danger bor1 hov-btn1 p-lr-15 trans-04 text-white">
                                    Eliminar producto
                                </a>
                            </div>
                        </div>

                    </div>
                    <hr>
            <?php endforeach;
            endif; ?>
            <div class="row p-b-10">

                <div class="offset-8 col-4">

                    <div class="block2-txt flex-w flex-r p-t-14 p-r-24 p-b-18">
                        <span class="ltext-101 cl3">
                            Total: <?= '$' . number_format($totalProducto, 2) ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="../controller/ProductoController.php?action=comprar<?php if($_SESSION['id']): echo '&idUsuario='.$_SESSION['id']; endif;?>" class="flex-c-m ltext-101 cl5 size-116 btn-warning bor1 hov-btn1 p-lr-15 trans-04">
                    Pagar ahora
                </a>
            </div>
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
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
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