<?php
// model/Vendedor.php
echo 'Current working directory \'model/Usuario.php\' :' . getcwd();
echo '<br>Real path to file: ' . realpath('../../config/conexion.php') . '<br>';
require_once("../../config/conexion.php");

class Vendedor extends Conexion
{
    private $nombre;
    private $empresa;
    private $documento;
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

    public function validarVendedor(string $email, string $password)
    {
        $sql="SELECT * FROM vendedor WHERE email=? AND contrasena=?";
        $arregloParametros=array($email,$password);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function verificarExistencia(string $email)
    {
        $sql="SELECT email FROM vendedor WHERE email=?";
        $arregloParametros=array($email);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function insertarVendedor(string $nombre, string $nombreEmpresa, string $documentoIdentidad, string $email, string $password, string $direccion, string $telefono)
    {
        $this->nombre=$nombre;
        $this->nombreEmpresa=$nombreEmpresa;
        $this->documentoIdentidad=$documentoIdentidad;
        $this->email=$email;
        $this->password=$password;
        $this->direccion=$direccion;
        $this->telefono=$telefono;
        $sql="INSERT INTO vendedor(nombre_completo, nombre_empresa, documento_identidad, email, contrasena, direccion, telefono) VALUES(?,?,?,?,?,?,?)";
        $insert=$this->conexion->prepare($sql);
        $arregloParametros=array($this->nombre, $this->nombreEmpresa,  $this->documentoIdentidad, $this->email, $this->password, $this->direccion, $this->telefono);
        $ResultadoInsert=$insert->execute($arregloParametros);
        $idInsert=$this->conexion->lastInsertID();
        return $idInsert;
    }



}
