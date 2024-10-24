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


class ProductoController
{

    private $categoriaModel;
    private $productoModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
        $this->productoModel = new Producto();
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
            echo "la Url actual es: " .$urlImagen;
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
}

$action = $_REQUEST['action'];
$productoController = new ProductoController();
switch ($action) {
    case "obtener":
        $productoController->ObtenerProducto();
        break;

    case "agregar":
        $productoController->InsertarProducto();

    case "formulario":
        $productoController->mostrarFormularioProducto();
        break;
    default:
        echo "Operación no válida";
}
