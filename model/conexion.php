<?php
//Conexion en servidor web
$conn = mysqli_connect("infoavance.com", "infoavance", "12F0A7A2Ce3!");
mysqli_select_db($conn, "craftplace");



class Database{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host = 'infoavance.com';
        $this->db = 'craftplace';
        $this->user = 'infoavance';
        $this->password = '12F0A7A2Ce3!';
        $this->charset = 'utf8mb4';
    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}

?>