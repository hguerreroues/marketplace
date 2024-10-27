<?php
include "../config/ruta.php";
// model/Categoria.php
//echo 'Current working directory \'model/FacturaModel.php\' :' . getcwd();
//echo '<br>Real path to file: ' . realpath(BASE_PATH.'/config/conexion.php') . '<br>';
require_once(BASE_PATH . "/config/conexion.php");

class Factura extends Conexion
{
    private $id;
    private $idUsuario;
    private $idDireccion;
    private $idTarjeta;
    private $total;
    private $idempotencyKey;
    private $fechaCreacion;
    private $estado;

    //Detalle de facturas
    private $idFactura;
    private $idProducto;
    private $cantidad;
    private $precioUnitario;
    private $impuestos;
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    public function insertarFactura(string $idUsuario, string $idDireccion, string $idTarjeta, string $total, string $idempotencyKey)
    {
        $this->idUsuario = $idUsuario;
        $this->idDireccion = $idDireccion;
        $this->idTarjeta = $idTarjeta;
        $this->total = $total;
        $this->idempotencyKey = $idempotencyKey;

        $sql = "INSERT INTO factura(id_usuario, id_direccion, id_tarjeta, total, idempotency_key) VALUES(?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array($this->idUsuario, $this->idDireccion, $this->idTarjeta, $this->total, $this->idempotencyKey);
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    public function insertarDetalleFactura(string $idFactura, string $idProducto, int $cantidad, float $precioUnitario, float $impuestos, float $total)
    {
        $this->idFactura = $idFactura;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
        $this->impuestos = $impuestos;
        $this->total = $total;

        $sql = "INSERT INTO factura_items(id_factura, id_producto, cantidad, precio_unitario, impuestos, total) VALUES(?,?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);
        $arregloParametros = array($this->idFactura, $this->idProducto, $this->cantidad, $this->precioUnitario, $this->impuestos, $this->total);
        $ResultadoInsert = $insert->execute($arregloParametros);
        $idInsert = $this->conexion->lastInsertID();
        return $idInsert;
    }

    public function obtenerFacturaPorId(string $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $sql = "SELECT * FROM factura WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);  // Usar prepare en lugar de query
        $stmt->execute([$this->idUsuario]);  // Ejecutar pasando el arreglo de parámetros
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetchAll con 'All' en mayúscula
        return $resultado;
    }
}
