<?php
session_start();
// controller/categoria/CategoriaController.php

// echo 'Current working directory \'controller/categoria/CategoriaController.php\': ' . getcwd();
// echo '<br>Real path to file: ' . realpath('../../model/Vendedor.php') . '<br>';
// echo '<br>Real path to file: ' . realpath('../../view/home.php') . '<br>';
require_once("../../model/CategoriaModel.php");


class CategoriaController
{

    private $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    public function InsertarCategoria()
    {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
    
        
        $verificacion = $this->categoriaModel->verificarExistencia($nombre, $descripcion);

        if ($verificacion != null) {
            $_SESSION['mensaje_error'] = 'La categoria ' . $nombre . ' ya está registrada, escriba una diferente para continuar el registro';
            header('Location: ../../view/registro_categoria.php');
        } else {
            //INSERTAR UN USUARIO NUEVO
            echo "insertar un nuevo usuario";
            $insert = $this->categoriaModel->insertarCategoria($nombre, $descripcion);

            if ($insert != null) {
                $_SESSION['mensaje_error'] = 'Categoria  ' . $nombre . ' creado con exito!';
                header('Location: ../../view/registro_categoria.php');
            } else {
                $_SESSION['mensaje_error'] = 'Hubo un error al crear la categoria, intente de nuevo.';
                header('Location: ../../view/registro_categoria.php');
            }
        }
    }

    public function ObtenerCategorias()
    {
        $ListaCategorias = $this->categoriaModel->obtenerCategorias();
        require_once("../../view/agregar_producto.php");
    }

}

$action = $_REQUEST['action'];
$categoriaController = new CategoriaController();
switch ($action) {
    case "obtener":
        $categoriaController->ObtenerCategorias();
        break;
    default:
        echo "Operación no válida";
}
