<?php
// model/Usuario.php
echo 'Current working directory \'model/Usuario.php\' :' . getcwd();
echo '<br>Real path to file: ' . realpath('../../config/conexion.php') . '<br>';
require_once("../../config/conexion.php");

class Usuario extends Conexion
{
    private $nombre;
    private $email;
    private $password;
    private $direccion;
    private $telefono;
    private $conexion;

    public function __construct()
    {
        $this->conexion=new Conexion();
        $this->conexion=$this->conexion->getConexion();
    }

    public function insertarUsuario(string $nombre, string $email, string $password, string $direccion, string $telefono)
    {
        $this->nombre=$nombre;
        $this->email=$email;
        $this->password=$password;
        $this->direccion=$direccion;
        $this->telefono=$telefono;
        $sql="INSERT INTO usuario(nombre_completo, direccion, telefono, correo_electronico, contrasena) VALUES(?,?,?,?,?)";
        $insert=$this->conexion->prepare($sql);
        $arregloParametros=array($this->nombre, $this->direccion, $this->telefono, $this->email,$this->password);
        $ResultadoInsert=$insert->execute($arregloParametros);
        $idInsert=$this->conexion->lastInsertID();
        return $idInsert;
    }

    public function validarUsuario(string $email, string $password)
    {
        $sql="SELECT * FROM usuario WHERE correo_electronico=? AND contrasena=?";
        $arregloParametros=array($email,$password);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function verificarExistencia(string $email)
    {
        $sql="SELECT correo_electronico FROM usuario WHERE correo_electronico=?";
        $arregloParametros=array($email);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function verUsuarios()
    {
        $sql="SELECT * FROM usuario ORDER BY id ASC";
        $execute=$this->conexion->query($sql);
        $resultado=$execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function recuperarUsuario($id)
    {
        $sql="SELECT * FROM usuario WHERE id=?";
        $arregloParametros=array($id);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function actualizarUsuario(int $id, string $email, string $password)
    {
        $this->email=$email;
        $this->password=$password;
        $sql="UPDATE usuario SET correo_electronico=?, password=? WHERE id='$id'"; //las consultas preparadas evitan inyeccion sql
        $update=$this->conexion->prepare($sql);
        $ArregloParametros=array($this->email,$this->password);
        $update->execute($ArregloParametros);
        $resultadoUpdate = $update->rowCount();
        return $resultadoUpdate;
    }

    //Se elimina de la vista, no asi de la base de datos
    public function eliminarUsuario(int $id, string $estado)
    {
        $sql="UPDATE usuario SET estado=? WHERE id=?"; //las consultas preparadas evitan inyeccion sql
        $update=$this->conexion->prepare($sql);
        $ArregloParametros=array($this->$estado, $this->$id);
        $resultadoDelete=$update->execute($ArregloParametros);
        return $resultadoDelete;
    }
}