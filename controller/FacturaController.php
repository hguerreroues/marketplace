<?php
session_start();
include "../config/ruta.php";
// controller/producto/ProductoController.php

//echo 'Current working directory \'controller/producto/FacturaController.php\': ' . getcwd();
// echo '<br>Real path to file: ' . realpath('../../model/Producto.php') . '<br>';
// echo '<br>Real path to file: ' . realpath('../../view/home.php') . '<br>';
// echo '<br>Inicia el require_once <br>';
require_once("../model/CategoriaModel.php");
require_once("../model/ProductoModel.php");
require_once("../model/TarjetaModel.php");
require_once("../model/FacturaModel.php");


class FacturaController
{

    private $facturaModel;
    private $categoriaModel;
    private $productoModel;
    private $tarjetaModel;
    private $direccionModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
        $this->productoModel = new Producto();
        $this->tarjetaModel = new Tarjeta();
        $this->facturaModel = new Factura();
        $this->direccionModel = new Direccion();
    }

    public function insertarFactura()
    {

        echo "insertarFactura";

        $idUsuario = $_REQUEST['idUsuario'];
        $nombreTarjeta = $_REQUEST['cardName'];
        $numeroTarjeta = $_REQUEST['cardNumber'];
        $fechaExpiracion = $_REQUEST['expiryDate'];
        $cvc = $_REQUEST['cvv'];
        $idempotencyKey = uniqid('idempotency_', true);
        $idTarjetaCredito = "0";
        $total = 0;
        $impuestos = 0;

        if (!isset($_SESSION['id']) && $idUsuario == null) {
            $_SESSION['mensaje_error'] = "Inicia sesión para procesar la compra";
            header("Location: ../view/login.php");
            exit;
        } else {

            $idDireccion = $_SESSION['id_direccion'];

            foreach ($_SESSION['carrito'] as $producto) {
                $precio = (float) str_replace('$', '', $producto['precio']);
                $cantidad = (int)$producto['cantidad'];
                $precioTotalProducto = $precio * $cantidad;
                $total += (float) $precioTotalProducto;
            }

            $idTarjeta = $this->tarjetaModel->insertarTarjeta($idUsuario, $nombreTarjeta, $numeroTarjeta, $fechaExpiracion, $cvc);
            if ($idTarjeta != null) {
                $idTarjetaCredito = $idTarjeta;
            }

            $idFactura = $this->facturaModel->InsertarFactura($idUsuario, $idDireccion, $idTarjetaCredito, $total, $idempotencyKey);
            if ($idFactura != null) {
                foreach ($_SESSION['carrito'] as $producto) {
                    $idProducto = $producto['id'];
                    $precioUnitario = (float) str_replace('$', '', $producto['precio']);
                    $cantidad = (int)$producto['cantidad'];
                    $total = $precioUnitario * $cantidad;
                    $idDetalleFactura = $this->facturaModel->InsertarDetalleFactura($idFactura, $idProducto, $cantidad, $precioUnitario, $impuestos, $total);
                }
                if ($idDetalleFactura != null) {
                    $_SESSION['mensaje_error'] = "Compra realizada con exito";
                    unset($_SESSION['carrito']);
                    $_SESSION['total_productos'] = (int) "0";

                    $direccion = $this->direccionModel->obtenerDireccionPorId($idUsuario);
                    header("Location: ../view/confirmacion_compra.php");
                }
            } else {
                $_SESSION['mensaje_error'] = "Error al realizar la compra";
                header("Location: ../view/home.php");
            }
        }
    }


    public function agregarCarritoCompras()
    {
        header('Content-Type: application/json');
        $id = $_REQUEST['id'];
        $cantidad = $_REQUEST['cantidad'];
        $precio = $_REQUEST['precio'];
        $nombre = $_REQUEST['nombre'];
        $url = $_REQUEST['url'];

        // Verifica si el carrito ya existe en la sesión
        if (!isset($_SESSION['carrito'])) {
            // Si no existe, inicializa el carrito
            $_SESSION['carrito'] = [];
        }

        // Busca si el producto ya está en el carrito
        $producto_existe = false;

        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id'] === $id) {
                // Si el producto ya existe, actualiza la cantidad
                $producto['cantidad'] += $cantidad;
                $producto_existe = true;
                break;
            }
        }

        // Si el producto no existe, agrégalo al carrito
        if (!$producto_existe) {
            $_SESSION['carrito'][] = [
                "id" => $id,
                "cantidad" => $cantidad,
                "precio" => $precio,
                "nombre" => $nombre,
                "url" => $url
            ];
        }

        $_SESSION['total_productos'] = (int)$_SESSION['total_productos'] + $cantidad;
        $totalProductos = $_SESSION['total_productos'];

        header("Location: ../view/home.php"); // Redirige a la misma página o a otra

        //echo $totalProductos;
    }

    public function eliminarCarritoCompras()
    {
        $id = $_REQUEST['id'];


        // Recorrer el carrito y eliminar el producto
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            if ($producto['id'] === $id) {
                $_SESSION['total_productos'] = (int) $_SESSION['total_productos'] - (int) $producto['cantidad'];
                unset($_SESSION['carrito'][$indice]); // Eliminar el producto
                $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el arreglo
                break;
            }
        }

        if (empty($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
        }
        // Redireccionar o recargar la página para ver los cambios
        header("Location: ../view/carrito_compras.php");
    }


    public function validarLoginParaCompraProducto()
    {
        $idUsuario = $_REQUEST['idUsuario'];
        echo "validarLoginParaCompraProducto()";

        if (!isset($_SESSION['id']) && $idUsuario == null) {
            $_SESSION['mensaje_error'] = "Inicia sesión para procesar la compra";
            header("Location: ../view/login.php");
            exit;
        } else {
            $_SESSION['mensaje_error'] = "";
            header("Location: ../view/pagar_compra.php");
        }
    }
}

$action = $_REQUEST['action'];
$facturaController = new FacturaController();
switch ($action) {
    case "agregarCarrito":
        $facturaController->agregarCarritoCompras();
        break;

    case "eliminarCarrito":
        $productoController->eliminarCarritoCompras();
        break;

    case "comprar":
        $facturaController->validarLoginParaCompraProducto();
        break;

    case "procesarPago":
        $facturaController->insertarFactura();
        break;

    default:
        echo "Operación no válida";
}
