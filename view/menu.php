<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="border-bottom: 0.1rem solid #b1c446">
    <a class="navbar-brand" href="/marketplace/view/dashboard.php">
        <img src="./assets/images/craftplace-logo.png" width="120" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav sidenav-not-toggled" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Perfil">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePerfil" data-parent="#exampleAccordion">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="nav-link-text">Perfil</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsePerfil">
                    <li>
                        <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> Ver perfil</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Productos">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProductos" data-parent="#exampleAccordion">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    <span class="nav-link-text">Productos</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseProductos">
                    <li>
                        <a href="agregar_producto.php"><i class="fa fa-user-o" aria-hidden="true"></i> Agregar productos</a>
                        <!-- <a href="../controller/categoria/CategoriaController.php?action=obtener"><i class="fa fa-user-o" aria-hidden="true"></i> Agregar productos</a> -->
                    </li>
                    <li>
                        <a href="lista_producto.php"><i class="fa fa-list" aria-hidden="true"></i> Lista de productos</a>
                    </li>
                    <li>
                        <!-- <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> Ofertas de productos</a> -->
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reportes">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseReportes" data-parent="#exampleAccordion">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <span class="nav-link-text">Report</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseReportes">
                    <li>
                        <a href="#"><i class="fa fa-area-chart" aria-hidden="true"></i> Ventas</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> Pagos </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#creditCardChargeModal"><i class="fa fa-usd" aria-hidden="true"></i> Comisiones</a>
                    </li>
                    
                </ul>
            </li>

        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i>Salir del sistema</a>
            </li>
        </ul>
    </div>
</nav>