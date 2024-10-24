<?php
session_start();
include "../ruta.php";
// controller/vendedor/VendedorController.php

// echo 'Current working directory \'controller/VendedorController.php\': ' . getcwd();
// echo '<br>Real path to file: ' . realpath('../model/VendedorModel.php') . '<br>';
// echo '<br>Real path to file: ' . realpath('../view/home.php') . '<br>';
require_once("../model/VendedorModel.php");


class VendedorController
{

    private $vendedorModel;

    public function __construct()
    {
        $this->vendedorModel = new Vendedor();
    }

    public function validarVendedor()
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $response_message = '';

        //Validar Vendedor
        $validarVendedor = $this->vendedorModel->validarVendedor($email, $password);

        if ($validarVendedor != null) {
            //creamos una nueva sesion de PHP y luego le mandamos los datos del vendedor que se acaba de validar
            session_start();
            $_SESSION["id"] = $validarVendedor["id"];
            $_SESSION["nombre_completo"] = $validarVendedor["nombre_completo"];
            $_SESSION["nombre_empresa"] = $validarVendedor["nombre_empresa"];
            $_SESSION["email"] = $validarVendedor["correo_electronico"];
            $_SESSION["sesion_vendedor"] = "true";
            header('Location: ../view/dashboard.php');
        } else {
            $_SESSION['mensaje_error'] = "Usuario ó contraseña incorrectos.";
            header('Location: ../view/login_vendedor.php');
        }
    }

    public function InsertarVendedor()
    {
        $nombre = $_REQUEST['nombre'];
        $empresa = $_REQUEST['nombreEmpresa'];
        $documentoIdentidad = $_REQUEST['documentoIdentidad'];
        $direccion = $_REQUEST['direccion'];
        $telefono = $_REQUEST['telefono'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $campos = [
            'nombre_completo' => $nombre,
            'nombre_empresa' => $empresa,
            'correo_electronico' => $email,
        ];
        
        $verificacion = $this->vendedorModel->verificarSiExiste($campos);
        

        if ($verificacion != null) {
            $_SESSION['mensaje_error'] = 'El usuario ' . $nombre . ' ya está registrado, escriba uno diferente para continuar el registro';
            header('Location: ../view/registro_vendedor.php');
        } else {
            //INSERTAR UN USUARIO NUEVO
            echo "insertar un nuevo usuario";
            $insert = $this->vendedorModel->insertarVendedor($nombre, $empresa, $documentoIdentidad, $email, $password, $direccion, $telefono);

            if ($insert != null) {
                $_SESSION['mensaje_error'] = 'Vendedor  ' . $nombre . ' creado con exito!';
                header('Location: ../view/login_vendedor.php');
            } else {
                $_SESSION['mensaje_error'] = 'Hubo un error al crear el usuario, intente de nuevo.';
                header('Location: ../view/registro_vendedor.php');
            }
        }
    }

    public function VerVendedores()
    {
        //$ListaVendedors = $this->vendedorModel->validarVendedor();
        require_once("../vistas/Vendedor/VerVendedors.php");
    }

    public function Eliminar($id, $estado)
    {
        $resultado = $this->vendedorModel->eliminarVendedor($id, $estado);
        if ($resultado) {
            header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=VerVendedors');
        } else {
            echo "Hubo un error en la eliminacion del usuario.";
        }
    }

    public function RecuperarVendedor($id)
    {
        $DatosRecuperados = $this->vendedorModel->RecuperarVendedor($id);
        require_once("../../Vistas/Vendedor/ModificarVendedor.php");
    }

    public function ActualizarVendedor()
    {
        $Id = $_REQUEST['Id'];
        $Vendedor = $_REQUEST['Vendedor'];
        $VendedorAnterior = $_REQUEST['VendedorAnterior'];
        $Rol = $_REQUEST['Rol'];
        $Contra = $_REQUEST['Contra'];
        $Verificacion = $this->vendedorModel->verificarSiExiste($Vendedor);

        if ($Verificacion != null) {
            if ($Vendedor == $VendedorAnterior) {
                //echo "Ya existe y es el original";
                //Modificar datos de Vendedor existente manteniendo el mismo nombre de usuario.
                $Update = $this->vendedorModel->actualizarVendedor($Id, $Vendedor, $Contra, $Rol);
                if ($Update == 1) {
                    header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Datos actualizados con exito! para el usuario ' . $Vendedor . '');
                } else {
                    header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Hubo un error al actualizar el usuario o no ha modificado ningun dato, intente de nuevo.');
                }
            } else {
                //Detenemos la actualizacion cuando el usuario se quiere cambiar por otro existente
                header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=El usuario ' . $Vendedor . ' ya esta en uso en el sistema por otra persona, ingrese uno nuevo o deje el original.');
            }
        } else {
            //Modificar Vendedor existente por un nuevo nombre de usuario
            $Update = $this->vendedorModel->actualizarVendedor($Id, $Vendedor, $Contra, $Rol);
            if ($Update == 1) {
                header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Datos actualizados con exito! se modificó el nombre de usuario ' . $VendedorAnterior . ' por ' . $Vendedor . '');
            } else {
                header('Location: ../../Controladores/Vendedor/VendedorController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Hubo un error al actualizar el usuario intente de nuevo.');
            }
        }
    }
}

$action = $_REQUEST['action'];
$vendedorController = new VendedorController();
switch ($action) {
    case "login":
        $vendedorController->validarVendedor();
        break;
    case "registro":
        $vendedorController->InsertarVendedor();
        break;
    case "VerVendedores":
        //$vendedorController->VerVendedors();
        break;
    case "Eliminar":
        $vendedorController->Eliminar($_REQUEST['id'], $_REQUEST['estado']);
        break;
    case "Cargar":
        $vendedorController->RecuperarVendedor($_REQUEST['Id']);
        break;
    case "Actualizar":
        $vendedorController->ActualizarVendedor();
        break;
    default:
        echo "Operación no válida";
}
