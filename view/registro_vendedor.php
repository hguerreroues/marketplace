<?php
session_start();
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
</head>

<style>
    .container-image {
        background-image: url('assets/images/tetera.jpg');
    }

    .login {
        width: 90%;
    }

</style>

<body>

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container-fluid">
                    <!-- Logo desktop -->
                    <a href="/marketplace" class="logo">
                        <img src="assets/images/craftplace-logo.png" alt="IMG-LOGO">
                    </a>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="/marketplace/"><img src="assets/images/craftplace-logo.png" alt="IMG-LOGO"></a>
            </div>
        </div>

    </header>

    <section style="padding-top: 8%;">
        <div class="container-fluid" style="height: 90vh;">
            <div class="row ">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="card login">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 pt-3 pb-2">
                                    <h3 class="card-title text-center">Registarse como vendedor</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pt-2 pb-4">
                                    <h6 class="card-subtitle mb-2 text-muted text-center">Ya tienes registro? <a href="login_vendedor.php" class="link">Inicia Sesión</a></h6>

                                </div>
                            </div>
                            <form action="../controller/VendedorController.php" method="POST">
                                <input type="hidden" name="action" id="action" value="registro">
                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre completo *</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Nombre completo" required="">
                                            <small id="nombreHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreEmpresa">Nombre de la empresa o negocio</label>
                                            <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" aria-describedby="nombreEmpresa" placeholder="Nombre de la empresa o negocio" required="">
                                            <small id="nombreEmpresaHelp" class="form-text text-muted pl-2">Agrega el nombre comercial</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="documentoIdentidad">Documento de identidad o registro</label>
                                            <input type="text" class="form-control" id="documentoIdentidad" name="documentoIdentidad" aria-describedby="documentoIdentidad" placeholder="Documento de identidad o registro" required="">
                                            <small id="documentoIdentidadHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" required="">
                                            <small id="emailHelp" class="form-text text-muted pl-2">Email válido, se confirmara con un correo electrónico</small>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña *</label>
                                            <input type="password" class="form-control" id="psw" placeholder="Contraseña" required="">
                                            <input type="hidden" id="password" name="password">
                                            <small id="passwordHelp" class="form-text text-muted pl-2">Contraseña de 8 digitos como mínimo</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="direccion" placeholder="Dirección" required="">
                                            <small id="direccionHelp" class="form-text text-muted pl-2"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="telefono" placeholder="Teléfono">
                                            <small id="telefonoHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3 p-t-20 p-b-20">
                                    <div class="col-12 text-center">
                                        <button type="submit" onclick="cifrarMD5();" class="btn stext-101 cl0 size-101 bg1 bor1 hov-btn1 btn-block btn-lg">Registrarse</button>
                                    </div>

                                    <div class="col-12 p-t-10 p-b-10">
                                        <div class="form-group pl-2">
                                            <a href="recuperar_password.php">Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>

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
    </section>



    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="assets/js/slick-custom.js"></script>
    <script src="vendor/parallax100/parallax100.js"></script>

    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>

    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <script src="vendor/sweetalert/sweetalert.min.js"></script>

    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/crypto-js.min.js"></script>
    <script src="assets/js/funciones.js"></script>

    <script>
        $(function() {
            document.getElementById("nombre").focus();
        });
    </script>

</body>

</html>