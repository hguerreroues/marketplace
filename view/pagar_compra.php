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
                    Procesar pedido
                </h3>
            </div>


            <div class="row p-b-10">

                <div class="col-md-7">
                    <?php
                    $totalProducto = 0;
                    if (!empty($_SESSION['carrito'])):
                        foreach ($_SESSION['carrito'] as $producto):
                            $totalProducto += (int) $producto['cantidad'] * (float) str_replace('$', '', $producto['precio']);
                    ?>

                            <div class="row">
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

                                </div>

                            </div>
                            <hr>
                    <?php endforeach;
                    endif; ?>
                </div>


                <div class="offset-md-1 col-md-4">

                    <div class="row p-b-10">
                        <div class="col-12">
                            <div class="block2-txt flex-w flex-r">
                                <span class="ltext-28 cl3 text-justify">
                                    Al completar tu pedido aceptas nuestras Condiciones de uso y venta. Consulta nuestro Aviso de privacidad, nuestro Aviso de Cookies y nuestro Aviso sobre publicidad basada en los intereses del usuario.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col-8">
                            <div class="block2-txt flex-w flex-l p-l-24">
                                <span class="ltext-32 cl3">
                                    Productos
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="block2-txt flex-w flex-r p-r-24">
                                <span class="ltext-32 cl3">
                                    <?= '$' . number_format($totalProducto, 2) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col-8">
                            <div class="block2-txt flex-w flex-l p-l-24">
                                <span class="ltext-32 cl3">Impuesto (IVA)</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="block2-txt flex-w flex-r p-r-24">
                                <span class="ltext-32 cl3">$0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col-8">
                            <div class="block2-txt flex-w flex-l p-l-24">
                                <span class="ltext-32 cl3">
                                    <strong>Importe total</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="block2-txt flex-w flex-r p-r-24">
                                <span class="ltext-32 cl3">
                                    <strong><?= '$' . number_format($totalProducto, 2) ?></strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col-12">
                            <div class="block2-txt flex-w flex-l">
                                <span class="ltext-28 cl3 text-left p-l-24 text-muted">
                                    * Todos los productos ya incluye el IVA.
                                </span>
                            </div>
                        </div>
                    </div>
                    

                    <div class="container-fluid">
                    <hr>
                        <form id="paymentForm" method="POST" action="../controller/ProductoController.php">
                            <input type="hidden" name="action" value="procesarPago">
                            <input type="hidden" name="idUsuario" value="<?=$_SESSION['id']?>">
                            <div class="form-group">
                                <label for="cardName">Nombre en la tarjeta</label>
                                <input type="text" class="form-control" id="cardName" name="cardName" required>
                                <div class="invalid-feedback">Por favor, ingresa el nombre en la tarjeta.</div>
                            </div>

                            <div class="form-group">
                                <label for="cardNumber">Número de tarjeta</label>
                                <input type="text" class="form-control" id="cardNumber" name="cardNumber" maxlength="19" onkeypress="formatCardNumber(event)" required>
                                <div class="invalid-feedback">Por favor, ingresa un número de tarjeta válido.</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expiryDate">Fecha de vencimiento</label>
                                    <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/AA" maxlength="5" onkeypress="formatExpiryDate(event)" required>
                                    <div class="invalid-feedback">Por favor, ingresa una fecha de vencimiento válida.</div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" onkeypress="formatCardNumber(event)" required>
                                    <div class="invalid-feedback">Por favor, ingresa el CVV.</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-12">
                            <div class="flex-c-m flex-w w-full">
                                <button type="submit" class="flex-c-m mtext-112 cl5 size-116 btn-warning bor1 hov-btn1 p-lr-25 trans-04">
                                    Procesar Pago
                                </a>
                            </div>
                        </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>




            <!-- Load more -->

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

    <script>
        function formatCardNumber(event) {
            const input = event.target;
            const value = input.value.replace(/\D/g, ''); // Elimina caracteres no numéricos
            const formattedValue = value.match(/.{1,4}/g)?.join(' ') || ''; // Agrupa en bloques de 4

            input.value = formattedValue;

            // Permitir solo números y espacio
            if (event.which < 48 || event.which > 57) {
                event.preventDefault();
            }
        }

        function formatExpiryDate(event) {
            const input = event.target;
            const value = input.value.replace(/\D/g, ''); // Elimina caracteres no numéricos

            // Solo permitir números y formatear como MM/YY
            if (event.which < 48 || event.which > 57) {
                event.preventDefault();
                return;
            }

            // Agregar "/" después de los primeros 2 dígitos
            if (value.length === 1) {
                if (parseInt(value) > 1) {
                    input.value = '1'; // Si se excede, establece el mes a 1
                } else {
                    input.value = value; // Agrega el separador
                }
            } else if (value.length === 2) {
                // Si el mes es mayor que 12, limitarlo a 12
                if (parseInt(value) > 12) {
                    input.value = '12/'; // Si se excede, establece el mes a 12
                } else {
                    input.value = value + '/';
                }
            } else if (value.length < 2) {
                input.value = value;
            } else if (value.length > 2) {
                input.value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
        }
        
    </script>

</body>

</html>