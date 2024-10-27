<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Carrito
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                <?php
                if (!empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto) {
                        $precio = (float) str_replace('$', '', $producto['precio']);
                        $cantidad = (int)$producto['cantidad'];
                        $precioTotalProducto = $precio * $cantidad;
                        $precioTotal += (float) $precioTotalProducto;

                        $precioTotalFormateado = '$' . number_format($precioTotal, 2);

                ?>


                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="<?= $producto['url'] ?>" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    <?= $producto['nombre'] ?>
                                </a>

                                <span class="header-cart-item-info">
                                    <?= $producto['cantidad'] ?> x <?= $producto['precio'] ?>
                                </span>
                            </div>
                        </li>
                <?php }
                } else {
                    echo '<p>El carrito está vacío.</p>';
                }
                ?>

            </ul>

            <div class="w-full">
                <?php if ($_SESSION['carrito']): ?>
                    <div class="header-cart-total w-full p-tb-40">
                        Total: <?= $precioTotalFormateado ?>
                    </div>



                    <div class="header-cart-buttons flex-w w-full">
                        <a href="carrito_compras.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Ver carrito
                        </a>

                        <a href="../controller/FacturaController.php?action=comprar<?php if ($_SESSION['id']): echo '&idUsuario=' . $_SESSION['id'];
                                                                                    endif; ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            <?php if ($_SESSION['carrito']): echo 'Pagar';
                            endif; ?>
                            Pagar
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>