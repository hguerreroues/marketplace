<?php
include "../config/ruta.php";
// model/Categoria.php
//echo 'Current working directory \'model/Categoria.php\' :' . getcwd();
//echo '<br>Real path to file: ' . realpath(BASE_PATH.'/config/conexion.php') . '<br>';
require_once(BASE_PATH."/config/conexion.php");

class Categoria extends Conexion
{
    private $nombre;
    private $descripcion;
    private $conexion;

    public function __construct()
    {
        $this->conexion=new Conexion();
        $this->conexion=$this->conexion->getConexion();
    }

    public function insertarCategoria(string $nombre, string $descripcion)
    {
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $sql="INSERT INTO categoria(nombre, descripcion) VALUES(?,?)";
        $insert=$this->conexion->prepare($sql);
        $arregloParametros=array($this->nombre, $this->descripcion);
        $ResultadoInsert=$insert->execute($arregloParametros);
        $idInsert=$this->conexion->lastInsertID();
        return $idInsert;
    }

    public function verificarExistencia(string $nombre)
    {
        $sql="SELECT * FROM categoria WHERE nombre=?";
        $arregloParametros=array($nombre);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerCategorias()
    {
        $sql="SELECT * FROM categoria ORDER BY id ASC";
        $execute=$this->conexion->query($sql);
        $resultado=$execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function actualizarCategoria(int $id, string $nombre, string $descripcion)
    {
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $sql="UPDATE categoria SET nombre=?, descripcion=? WHERE id='$id'"; //las consultas preparadas evitan inyeccion sql
        $update=$this->conexion->prepare($sql);
        $ArregloParametros=array($this->nombre,$this->descripcion);
        $update->execute($ArregloParametros);
        $resultadoUpdate = $update->rowCount();
        return $resultadoUpdate;
    }

}