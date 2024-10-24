<?php
// model/Vendedor.php
// echo 'Current working directory \'model/Vendedor.php\' :' . getcwd();
// echo '<br>Real path to file: ' . realpath('../../config/conexion.php') . '<br>';
require_once("../config/conexion.php");

class Vendedor extends Conexion
{
    private $nombre;
    private $empresa;
    private $documentoIdentidad;
    private $email;
    private $password;
    private $direccion;
    private $telefono;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    //Inserta un vendedor en la tabla.
    public function insertarVendedor(string $nombre, string $empresa, string $documentoIdentidad, string $email, string $password, string $direccion, string $telefono)
    {
        $this->nombre = $nombre;
        $this->empresa = $empresa;
        $this->documentoIdentidad = $documentoIdentidad;
        $this->email = $email;
        $this->password = $password;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $sql = "INSERT INTO vendedor(nombre_completo, nombre_empresa, documento_identidad, direccion, telefono, correo_electronico, contrasena) VALUES(?,?,?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array($this->nombre, $this->empresa, $this->documentoIdentidad, $this->direccion, $this->telefono, $this->email, $this->password);
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    //Funcion para validar si existe registro de vendedor por usuario y contraseña
    public function validarVendedor(string $email, string $password)
    {
        $sql = "SELECT * FROM vendedor WHERE correo_electronico=? AND contrasena=?";
        $arregloParametros = array($email, $password);
        $query = $this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Array para verificar si existen datos de un vendedor, se puede enviar varios datos 
    /*

    $campos = [
        'nombre_completo' => 'Hector Guerrero',
        'nombre_empresa' => "Grupo4",
        'correo_electronico' => 'usuario@ejemplo.com',
        'telefono' => '123456789'
    ];

    $resultado = $this->verificarSiExiste($campos);

    if ($resultado) {
        echo "El registro existe";
    } else {
        echo "No se encontró el registro";
    }
    */
    public function verificarSiExiste(array $campos)
    {
        $condiciones = [];
        $valores = [];
        foreach ($campos as $campo => $valor) {
            $condiciones[] = "$campo = ?";
            $valores[] = $valor;
        }
        $condicionesSql = implode(' AND ', $condiciones);
        $sql = "SELECT * FROM vendedor WHERE $condicionesSql";
        //$arregloParametros=array($email);
        $query = $this->conexion->prepare($sql);
        $query->execute($valores);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Se obtiene la lista de vendedores que estan activos (activos=1, inactivos=0)
    public function verListaVendedores()
    {
        $sql = "SELECT * FROM vendedor WHERE estado='1' ORDER BY id ASC";
        $execute = $this->conexion->query($sql);
        $resultado = $execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Se recupera el vendedor por ID
    public function recuperarVendedor($id)
    {
        $sql = "SELECT * FROM vendedor WHERE id=?";
        $arregloParametros = array($id);
        $query = $this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Pendiente de completar la actualizacion
    public function actualizarVendedor(int $id, string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $sql = "UPDATE vendedor SET correo_electronico=?, password=? WHERE id='$id'"; //las consultas preparadas evitan inyeccion sql
        $update = $this->conexion->prepare($sql);
        $ArregloParametros = array($this->email, $this->password);
        $update->execute($ArregloParametros);
        $resultadoUpdate = $update->rowCount();
        return $resultadoUpdate;
    }

    //Se elimina de la vista, no asi de la base de datos
    public function eliminarVendedor(int $id, string $estado)
    {
        $sql = "UPDATE vendedor SET estado=? WHERE id=?"; //las consultas preparadas evitan inyeccion sql
        $update = $this->conexion->prepare($sql);
        $ArregloParametros = array($this->$estado, $this->$id);
        $resultadoDelete = $update->execute($ArregloParametros);
        return $resultadoDelete;
    }
}
