<?php
session_start();
include "../config/ruta.php";
// controller/producto/ProductoController.php

//echo 'Current working directory \'controller/producto/ProductoController.php\': ' . getcwd();
// echo '<br>Real path to file: ' . realpath('../../model/Producto.php') . '<br>';
// echo '<br>Real path to file: ' . realpath('../../view/home.php') . '<br>';
// echo '<br>Inicia el require_once <br>';
require_once("../model/CategoriaModel.php");
require_once("../model/ProductoModel.php");
require_once("../model/TarjetaModel.php");
require_once("../model/FacturaModel.php");


class ProductoController
{

    private $categoriaModel;
    private $productoModel;
    private $tarjetaModel;
    private $facturaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
        $this->productoModel = new Producto();
        $this->tarjetaModel = new Tarjeta();
        $this->facturaModel = new Factura();
    }

    public function InsertarProducto()
    {

        $directorio = BASE_PATH . "/view/assets/images/";

        // Crear la carpeta si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcionProducto'];
        $cantidad = $_REQUEST['cantidadProducto'];
        $peso = $_REQUEST['pesoProducto'];
        $precioNeto = $_REQUEST['precioNetoProducto'];
        $precioLista = $_REQUEST['precioVentaProducto'];
        $descuento = $_REQUEST['porcentajeDescuento'];
        $categoria = $_REQUEST['categoria'];
        $idVendedor = $_REQUEST['idVendedor'];
        $urlImagen = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['agregarFoto'])) {
            // Obtener información del archivo
            $archivo = $_FILES['agregarFoto'];
            $nombreArchivo = basename($archivo['name']);
            $rutaDestino = $directorio . $nombreArchivo;
            $tipoArchivo = strtolower(pathinfo($rutaDestino, PATHINFO_EXTENSION));
            $tamanoArchivo = $archivo['size'];

            // Validar el tipo de archivo (solo .jpg y .png)
            $tiposPermitidos = ['jpg', 'jpeg', 'png'];
            if (!in_array($tipoArchivo, $tiposPermitidos)) {
                echo "Error: Solo se permiten archivos .jpg y .png.";
                exit();
            }

            // Validar el tamaño del archivo (máximo 5 MB)
            $tamanioMaximo = 5 * 1024 * 1024; // 5 MB en bytes
            if ($tamanoArchivo > $tamanioMaximo) {
                echo "Error: El archivo excede el tamaño máximo permitido de 5 MB.";
                exit();
            }
            $urlImagen = "https://infoavance.com/marketplace/view/assets/images/" . $nombreArchivo;
            echo "la Url actual es: " . $urlImagen;
            // Intentar mover el archivo al directorio de destino
            if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                echo "El archivo " . htmlspecialchars($nombreArchivo) . " ha sido subido exitosamente.";
            } else {
                echo "Error: Hubo un problema al subir el archivo.";
            }
        } else {
            echo "No se ha enviado ningún archivo.";
        }

        $verificacion = $this->productoModel->verificarExistencia($nombre);

        if ($verificacion != null) {
            $_SESSION['mensaje_error'] = 'El producto ' . $nombre . ' ya está registrado, agregue otro producto para continuar el registro';
            header('Location: ../view/agregar_producto.php');
        } else {
            //INSERTAR UN USUARIO NUEVO
            echo "insertar un nuevo PRODUCTO";
            $insert = $this->productoModel->insertarProducto(
                $nombre,
                $descripcion,
                $cantidad,
                $peso,
                $precioNeto,
                $precioLista,
                $descuento,
                $categoria,
                $idVendedor,
                $urlImagen
            );

            if ($insert != null) {
                $_SESSION['mensaje_error'] = 'Producto  ' . $nombre . ' creado con exito!';
                header('Location: ../view/agregar_producto.php');
            } else {
                $_SESSION['mensaje_error'] = 'Hubo un error al crear el producto, intente de nuevo.';
                header('Location: ../view/agregar_producto.php');
            }
        }
    }

    public function ObtenerProducto()
    {
        $ListaCategorias = $this->categoriaModel->obtenerCategorias();
        require_once("../view/lista_producto.php");
    }

    public function mostrarFormularioProducto()
    {
        echo "mostrarFormularioProducto()";
        // Obtener las categorías desde el modelo
        $categorias = $this->categoriaModel->obtenerCategorias();

        // Cargar la vista y pasar las categorías
        require_once("../../view/agregar_producto.php");
    }

    public function ObtenerProductoPorID()
    {
        header('Content-Type: application/json');
        $id = $_REQUEST['id'];
        $response = array();
        $listaProductos = $this->productoModel->obtenerProductosPorId($id);
        if ($listaProductos != null) {
            http_response_code(200);
            $response['estado'] = "Exito";
            $response['data'] = $listaProductos;
        } else {
            http_response_code(404);
            $response['estado'] = "Error";
            $response['data'] = [];
        }
        echo json_encode($response);
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

        if (!isset($_SESSION['id']) && $idUsuario == null) {
            $_SESSION['mensaje_error'] = "Inicia sesión para procesar la compra";
            header("Location: ../view/login.php");
            exit;
        } else {
            $_SESSION['mensaje_error'] = "";
            header("Location: ../view/pagar_compra.php");
        }
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

                    //$direccion = $this->direccionModel->obtenerDireccionPorId($idUsuario);
                    header("Location: ../view/confirmacion_compra.php");
                }
            } else {
                $_SESSION['mensaje_error'] = "Error al realizar la compra";
                header("Location: ../view/home.php");
            }
        }
    }
}

$action = $_REQUEST['action'];
$productoController = new ProductoController();
switch ($action) {
    case "obtener":
        $productoController->ObtenerProducto();
        break;

    case "agregar":
        $productoController->InsertarProducto();
        break;

    case "formulario":
        $productoController->mostrarFormularioProducto();
        break;

    case "obtenerId":
        $productoController->ObtenerProductoPorID();
        break;

    case "agregarCarrito":
        $productoController->agregarCarritoCompras();
        break;

    case "eliminarCarrito":
        $productoController->eliminarCarritoCompras();
        break;

    case "comprar":
        $productoController->validarLoginParaCompraProducto();
        break;

    case "procesarPago":
        $productoController->insertarFactura();
        break;

    default:
        echo "Operación no válida";
}
