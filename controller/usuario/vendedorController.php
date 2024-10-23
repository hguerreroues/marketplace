<?php
// Verificar si se ha enviado el formulario
/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre'])) : '';
    $nombreEmpresa = isset($_POST['nombreEmpresa']) ? htmlspecialchars(trim($_POST['nombreEmpresa'])) : '';
    $documentoIdentidad = isset($_POST['documentoIdentidad']) ? htmlspecialchars(trim($_POST['documentoIdentidad'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
    $direccion = isset($_POST['direccion']) ? htmlspecialchars(trim($_POST['direccion'])) : '';
    $telefono = isset($_POST['telefono']) ? htmlspecialchars(trim($_POST['telefono'])) : '';
    var_dump($email);
    // Mostrar los valores introducidos
    echo "<h2>Valores introducidos:</h2>";
    echo "<p><strong>Nombre completo:</strong> " . $nombre . "</p>";
    echo "<p><strong>Nombre de la empresa:</strong> " . $nombreEmpresa . "</p>";
    echo "<p><strong>Documento de identidad:</strong> " . $documentoIdentidad . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
    echo "<p><strong>Contraseña:</strong> " . $password . "</p>"; // Asegúrate de no mostrar la contraseña en producción
    echo "<p><strong>Dirección:</strong> " . $direccion . "</p>";
    echo "<p><strong>Teléfono:</strong> " . $telefono . "</p>";
} else {
    // Si no se ha enviado el formulario
    echo "<p>No se han enviado datos.</p>";
} */




// controller/usuario/vendedorController.php

echo 'Current working directory \'controller/usuario/vendedorController.php\': ' . getcwd();
echo '<br>Real path to file: ' . realpath('../../model/Vendedor.php') . '<br>';
echo '<br>Real path to file: ' . realpath('../../view/home.php') . '<br>';
require_once("../../model/Vendedor.php");


class vendedorController
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

        //Validar Usuario
        $validarVendedor = $this->vendedorModel->validarVendedor($email, $password);
        
        if ($validarVendedor != null) {
            #creamos una nueva sesion de PHP y luego le mandamos los datos del usuario que se acaba de validar
            session_start();
            $_SESSION["id"] = $validarVendedor["id"];
            $_SESSION["email"] = $validarVendedor["email"];
            $_SESSION["nombreCompleto"] = $validarVendedor["nombre_completo"];
            header('Location: ../../view/dashboard.php');
        } else {
            $response_message = "Usuario ó contraseña incorrectos.";
            header('Location: ../../view/login_vendedor.php?mensaje=' . $response_message);
        }
    }



    public function InsertarVendedor()
    {
        $nombre = $_REQUEST['nombre'];
        $nombreEmpresa = $_REQUEST['nombreEmpresa'];
        $documentoIdentidad = $_REQUEST['documentoIdentidad'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $direccion = $_REQUEST['direccion'];
        $telefono = $_REQUEST['telefono'];
        
        $verificacion = $this->vendedorModel->VerificarExistencia($email);
        

        if ($verificacion != null) {
            header('Location: ../../view/registro_vendedor.php?mensaje=El usuario ' . $nombre . ' ya existe, escriba uno diferente para continuar el registro');
        } else {
            //INSERTAR UN USUARIO NUEVO
            echo "insertar un nuevo usuario";
            $insert = $this->vendedorModel->insertarVendedor($nombre,  $nombreEmpresa, $documentoIdentidad, $email, $password, $direccion, $telefono);

            if ($insert != null) {
                header('Location: ../../view/login_vendedor.php?mensaje=Usuario  ' . $nombre . ' creado con exito!');
            } else {
                header('Location: ../../view/registro_vendedor.php?mensaje=Hubo un error al crear el usuario, intente de nuevo.');
            }
        }
    }
}

$action = $_REQUEST['action'];
$vendedorController = new vendedorController();
switch ($action) {
    case "login":
        $vendedorController->validarVendedor();
        break;
    case "registro":
        $vendedorController->InsertarVendedor();
        break;
    
    default:
        echo "Operación no válida";
}
