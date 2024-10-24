<?php
// model/ProductoModel.php
include "../config/ruta.php";
// echo 'Current working directory \'model/ProductoModel.php\' : ' . getcwd();
// echo '<br>Real path to file: ' . realpath('../config/conexion.php') . '<br>';
require_once("../config/conexion.php");

class Producto extends Conexion
{
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $peso;
    private $precioNeto;
    private $precioLista;
    private $descuento;
    private $estado;
    private $idCategoria;
    private $idVendedor;
    private $urlImagen;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    public function insertarProducto(
        string $nombre,
        string $descripcion,
        int $cantidad,
        float $peso,
        float $precioNeto,
        float $precioLista,
        float $descuento,
        int $idCategoria,
        int $idVendedor,
        string $urlImagen
    ) {
        //echo "insertarProducto()";
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->peso = $peso;
        $this->precioNeto = $precioNeto;
        $this->precioLista = $precioLista;
        $this->descuento = $descuento;
        $this->idCategoria = $idCategoria;
        $this->idVendedor = $idVendedor;
        $this->urlImagen = $urlImagen;
        $sql = "INSERT INTO producto(nombre, descripcion, cantidad, peso, precio_neto, precio_lista, 
        descuento, id_categoria, id_vendedor, url_imagen) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array(
            $this->nombre,
            $this->descripcion,
            $this->cantidad,
            $this->peso,
            $this->precioNeto,
            $this->precioLista,
            $this->descuento,
            $this->idCategoria,
            $this->idVendedor,
            $this->urlImagen
        );
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    public function verificarExistencia(string $nombre)
    {
        $sql = "SELECT * FROM categoria WHERE nombre=?";
        $arregloParametros = array($nombre);
        $query = $this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerProductosPorVendedor(string $idVendedor)
    {
        $this->idVendedor = $idVendedor;
        $sql = "SELECT * FROM producto WHERE id_vendedor = ?";
        $stmt = $this->conexion->prepare($sql);  // Usar prepare en lugar de query
        $stmt->execute([$this->idVendedor]);  // Ejecutar pasando el arreglo de parámetros
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetchAll con 'All' en mayúscula
        return $resultado;
    }

    public function obtenerTodosLosProductos()
    {
        $sql="SELECT * FROM producto ORDER BY id ASC";
        $execute=$this->conexion->query($sql);
        $resultado=$execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
