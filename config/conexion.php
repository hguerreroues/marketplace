<?php
// config/conexion.php

// Conexion en servidor web
// $conn = mysqli_connect("infoavance.com", "infoavance", "12F0A7A2Ce3!");
// mysqli_select_db($conn, "craftplace");

class Conexion
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset;
    public $conn;

    public function __construct()
    {
        /* $this->host = 'infoavance.com';
        $this->db_name = 'craftplace';
        $this->username = 'infoavance';
        $this->password = '12F0A7A2Ce3!';
        $this->charset = 'utf8mb4'; */

        $this->host = 'localhost';
        $this->db_name = 'craftplace';
        $this->username = 'root';
        $this->password = '';
        $this->charset = 'utf8mb4';
    }

    function getConexion()
    {
        $this->conn = null;
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $conn = new PDO($connection, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            print_r('Error de conexión: ' . $exception->getMessage());
        }
        return $conn;
    }
}
