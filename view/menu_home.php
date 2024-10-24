<div class="container-menu-desktop">
    <!-- Topbar -->
    <!-- 
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Envio gratis por ordenes arriba de $100.00
                    </div>

                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            Ayuda & FAQs
                        </a>

                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            Mi cuenta
                        </a>

                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            USD
                        </a>
                    </div>
                </div>
            </div>
            -->

    <div class="wrap-menu-desktop">
        <nav class="limiter-menu-desktop container">

            <!-- Logo desktop -->
            <a href="#" class="logo">
                <img src="./assets/images/craftplace-logo.png" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li class="active-menu">
                        <a href="#">Inicio</a>
                    </li>

                    <li>
                        <a href="#">Categorias</a>
                    </li>

                    <li>
                        <a href="#">Favoritos</a>
                    </li>

                    <li>
                        <a href="login_vendedor.php">Vender</a>
                    </li>
                    <?php
                    if (!isset($_SESSION['sesion'])) { ?>
                        <li>
                            <a href="login.php">Iniciar Sesion</a>
                        </li>


                        <li>
                            <a href="registro.php">Registrarse</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m">
                <ul class="main-menu">

                    <li>
                        <a href="#">
                            <?php if (isset($_SESSION['sesion'])) {
                                echo "Bienvenido, " . $_SESSION['nombre_completo'];
                            } ?>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesion</a></li>

                        </ul>
                    </li>

                </ul>


                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>
        </nav>
    </div>
</div>

<!-- Header Mobile -->
<div class="wrap-header-mobile">
    <!-- Logo moblie -->
    <div class="logo-mobile">
        <a href="#"><img src="./assets/images/craftplace-logo.png" alt="IMG-LOGO"></a>
    </div>

    <!-- Icon header -->
    <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
        </div>

        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="0">
            <i class="zmdi zmdi-shopping-cart"></i>
        </div>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
            <i class="zmdi zmdi-favorite-outline"></i>
        </a>
    </div>

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </div>
</div>


<!-- Menu Mobile -->
<div class="menu-mobile">

    <ul class="main-menu-m">
        <li>
            <a href="#">Inicio</a>
        </li>
        <li>
            <a href="#">Categorias</a>
        </li>

        <li>
            <a href="#">Favoritos</a>
        </li>

        <li>
            <a href="login-vendedor.php">Vender</a>
        </li>
        <?php
        if (!isset($_SESSION['sesion'])) { ?>
            <li>
                <a href="login.php">Iniciar Sesion</a>
            </li>


            <li>
                <a href="registro.php">Registrarse</a>
            </li>
        <?php } ?>
    </ul>
</div>