<?php
include "../config/ruta.php";
// model/Categoria.php
//echo 'Current working directory \'model/DireccionModel.php\' :' . getcwd();
//echo '<br>Real path to file: ' . realpath(BASE_PATH.'/config/conexion.php') . '<br>';
require_once(BASE_PATH . "/config/conexion.php");

class Direccion extends Conexion
{
    private $id;
    private $idUsuario;
    private $direccion1;
    private $direccion2;
    private $municipio;
    private $departamento;
    private $ciudad;
    private $estado;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    public function insertarDireccion(string $idUsuario, string $direccion1, string $direccion2, string $municipio, string $departamento, string $ciudad)
    {
        $this->idUsuario = $idUsuario;
        $this->direccion1 = $direccion1;
        $this->direccion2 = $direccion2;
        $this->municipio = $municipio;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $sql = "INSERT INTO direcciones(id_usuario, direccion1, direccion2, municipio, departamento, ciudad) VALUES(?,?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array($this->idUsuario, $this->direccion1, $this->direccion2, $this->municipio, $this->departamento, $this->ciudad);
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    public function obtenerDirecciones()
    {
        $sql = "SELECT * FROM direcciones ORDER BY id ASC";
        $execute = $this->conexion->query($sql);
        $resultado = $execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerDireccionPorId(string $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $sql = "SELECT * FROM direcciones WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);  // Usar prepare en lugar de query
        $stmt->execute([$this->idUsuario]);  // Ejecutar pasando el arreglo de parámetros
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);  // fetchAll con 'All' en mayúscula
        return $resultado;
    }

    public function actualizarDirecciones(string $idUsuario, string $direccion1, string $direccion2, string $municipio, string $departamento, string $ciudad)
    {
        $this->idUsuario = $idUsuario;
        $this->direccion1 = $direccion1;
        $this->direccion2 = $direccion2;
        $this->municipio = $municipio;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $sql = "UPDATE direcciones SET direccion1=?, direccion2=?, municipio=?, departamento=?, ciudad=? WHERE id_usuario='$idUsuario'"; //las consultas preparadas evitan inyeccion sql
        $update = $this->conexion->prepare($sql);
        $ArregloParametros = array($this->direccion1, $this->direccion2, $this->municipio, $this->departamento, $this->ciudad);
        $update->execute($ArregloParametros);
        $resultadoUpdate = $update->rowCount();
        return $resultadoUpdate;
    }
}
