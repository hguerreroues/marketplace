<?php
include "../config/ruta.php";
// model/Categoria.php
//echo 'Current working directory \'model/TarjetaModel.php\' :' . getcwd();
//echo '<br>Real path to file: ' . realpath(BASE_PATH.'/config/conexion.php') . '<br>';
require_once(BASE_PATH . "/config/conexion.php");

class Tarjeta extends Conexion
{
    private $id;
    private $idUsuario;
    private $nombreTarjeta;
    private $numeroTarjeta;
    private $fechaExpiracion;
    private $cvc;
    private $monto;
    private $estado;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    public function insertarTarjeta(string $idUsuario, string $nombreTarjeta, string $numeroTarjeta, string $fechaExpiracion, string $cvc)
    {
        $this->idUsuario = $idUsuario;
        $this->nombreTarjeta = $nombreTarjeta;
        $this->numeroTarjeta = $numeroTarjeta;
        $this->fechaExpiracion = $fechaExpiracion;
        $this->cvc = $cvc;

        $sql = "INSERT INTO tarjeta_credito(id_usuario, nombre_tarjeta, numero_tarjeta, fecha_expiracion, cvc) VALUES(?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array($this->idUsuario, $this->nombreTarjeta, $this->numeroTarjeta, $this->fechaExpiracion, $this->cvc);
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    public function obtenerTarjetasPorId(string $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $sql = "SELECT * FROM tarjeta_credito WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);  // Usar prepare en lugar de query
        $stmt->execute([$this->idUsuario]);  // Ejecutar pasando el arreglo de parámetros
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetchAll con 'All' en mayúscula
        return $resultado;
    }

    public function obtenerTarjetasPorDatos(string $idUsuario, string $nombreTarjeta, string $numeroTarjeta, string $fechaExpiracion, string $cvc)
    {
        $this->idUsuario = $idUsuario;
        $this->nombreTarjeta = $nombreTarjeta;
        $this->numeroTarjeta = $numeroTarjeta;
        $this->fechaExpiracion = $fechaExpiracion;
        $this->cvc = $cvc;
        $sql = "SELECT * FROM tarjeta_credito WHERE id_usuario = ? AND nombre_tarjeta=? AND numero_tarjeta=? AND fecha_expiracion=? AND cvc=?";
        $stmt = $this->conexion->prepare($sql);  // Usar prepare en lugar de query
        $stmt->execute([$this->idUsuario, $this->idUsuario, $this->nombreTarjeta, $this->numeroTarjeta, $this->fechaExpiracion, $this->$cvc]);  // Ejecutar pasando el arreglo de parámetros
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetchAll con 'All' en mayúscula
        return $resultado;
    }

}
