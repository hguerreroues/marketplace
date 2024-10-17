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

    <section class="bg0">
        <div class="container-fluid" style="height: 90vh;">
            <div class="row">
            <div class="col-lg-6 container-image">
                </div>
                <div class="col-lg-6 centrar-vertical">
                    <div class="card login">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 pt-4 pb-2">
                                    <h3 class="card-title text-center">Recuperar contraseña</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pt-3 pb-5">
                                    <h6 class="card-subtitle mb-2 text-muted text-center">Ya tienes registro? <a href="login.php" class="link">Inicia sesión</a></h6>

                                </div>
                            </div>
                            <form>
                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email">
                                            <small id="emailHelp" class="form-text text-muted">Email válido, se confirmara con un correo electrónico</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">Contraseña *</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                            <small id="passwordHelp" class="form-text text-muted">Contraseña de 8 digitos como mínimo</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="passwordRepetido">Repetir Contraseña *</label>
                                            <input type="password" class="form-control" id="passwordRepetido" name="passwordRepetido" placeholder="Repetir Contraseña">
                                            <small id="passwordRepetidoHelp" class="form-text text-muted">Repita la contraseña</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-3 p-t-40 p-b-40">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn stext-101 cl0 size-101 bg1 bor1 hov-btn1 btn-block btn-lg">Recuperar contraseña</button>
                                    </div>
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

</body>

</html>