<?php
// controller/usuario/UsuarioController.php

echo 'Current working directory \'controller/usuario/UsuarioController.php\': ' . getcwd();
echo '<br>Real path to file: ' . realpath('../../model/Usuario.php') . '<br>';
echo '<br>Real path to file: ' . realpath('../../view/home.php') . '<br>';
require_once("../../model/Usuario.php");


class UsuarioController
{

    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function validarUsuario()
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $response_message = '';

        //Validar Usuario
        $validarUsuario = $this->usuarioModel->validarUsuario($email, $password);

        if ($validarUsuario != null) {
            //creamos una nueva sesion de PHP y luego le mandamos los datos del usuario que se acaba de validar
            session_start();
            $_SESSION["id"] = $validarUsuario["id"];
            $_SESSION["email"] = $validarUsuario["correo_electronico"];
            $_SESSION["nombreCompleto"] = $validarUsuario["nombre_completo"];
            header('Location: ../../view/home.php');
        } else {
            $response_message = "Usuario ó contraseña incorrectos.";
            header('Location: ../../view/login.php?mensaje=' . $response_message);
        }
    }

    public function InsertarUsuario()
    {
        $nombre = $_REQUEST['nombre'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $direccion = $_REQUEST['direccion'];
        $telefono = $_REQUEST['telefono'];
        
        $verificacion = $this->usuarioModel->VerificarExistencia($email);
        

        if ($verificacion != null) {
            header('Location: ../../view/registro.php?mensaje=El usuario ' . $nombre . ' ya existe, escriba uno diferente para continuar el registro');
        } else {
            //INSERTAR UN USUARIO NUEVO
            echo "insertar un nuevo usuario";
            $insert = $this->usuarioModel->insertarUsuario($nombre, $email, $password, $direccion, $telefono);

            if ($insert != null) {
                header('Location: ../../view/login.php?mensaje=Usuario  ' . $nombre . ' creado con exito!');
            } else {
                header('Location: ../../view/registro.php?mensaje=Hubo un error al crear el usuario, intente de nuevo.');
            }
        }
    }

    public function VerUsuarios()
    {
        $ListaUsuarios = $this->usuarioModel->VerUsuarios();
        require_once("../vistas/Usuario/VerUsuarios.php");
    }

    public function Eliminar($id, $estado)
    {
        $resultado = $this->usuarioModel->eliminarUsuario($id, $estado);
        if ($resultado) {
            header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=VerUsuarios');
        } else {
            echo "Hubo un error en la eliminacion del usuario.";
        }
    }

    public function RecuperarUsuario($id)
    {
        $DatosRecuperados = $this->usuarioModel->RecuperarUsuario($id);
        require_once("../../Vistas/Usuario/ModificarUsuario.php");
    }

    public function ActualizarUsuario()
    {
        $Id = $_REQUEST['Id'];
        $Usuario = $_REQUEST['Usuario'];
        $UsuarioAnterior = $_REQUEST['UsuarioAnterior'];
        $Rol = $_REQUEST['Rol'];
        $Contra = $_REQUEST['Contra'];
        $Verificacion = $this->usuarioModel->VerificarExistencia($Usuario);

        if ($Verificacion != null) {
            if ($Usuario == $UsuarioAnterior) {
                //echo "Ya existe y es el original";
                //Modificar datos de Usuario existente manteniendo el mismo nombre de usuario.
                $Update = $this->usuarioModel->actualizarUsuario($Id, $Usuario, $Contra, $Rol);
                if ($Update == 1) {
                    header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Datos actualizados con exito! para el usuario ' . $Usuario . '');
                } else {
                    header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Hubo un error al actualizar el usuario o no ha modificado ningun dato, intente de nuevo.');
                }
            } else {
                //Detenemos la actualizacion cuando el usuario se quiere cambiar por otro existente
                header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=El usuario ' . $Usuario . ' ya esta en uso en el sistema por otra persona, ingrese uno nuevo o deje el original.');
            }
        } else {
            //Modificar Usuario existente por un nuevo nombre de usuario
            $Update = $this->usuarioModel->actualizarUsuario($Id, $Usuario, $Contra, $Rol);
            if ($Update == 1) {
                header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Datos actualizados con exito! se modificó el nombre de usuario ' . $UsuarioAnterior . ' por ' . $Usuario . '');
            } else {
                header('Location: ../../Controladores/Usuario/UsuarioController.php?Tipo=Cargar&Id=' . $Id . '&mensaje=Hubo un error al actualizar el usuario intente de nuevo.');
            }
        }
    }
}

$action = $_REQUEST['action'];
$usuarioController = new UsuarioController();
switch ($action) {
    case "login":
        $usuarioController->validarUsuario();
        break;
    case "registro":
        $usuarioController->InsertarUsuario();
        break;
    case "VerUsuarios":
        $usuarioController->VerUsuarios();
        break;
    case "Eliminar":
        $usuarioController->Eliminar($_REQUEST['id'], $_REQUEST['estado']);
        break;
    case "Cargar":
        $usuarioController->RecuperarUsuario($_REQUEST['Id']);
        break;
    case "Actualizar":
        $usuarioController->ActualizarUsuario();
        break;
    default:
        echo "Operación no válida";
}
