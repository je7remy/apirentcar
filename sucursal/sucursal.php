<?php 
class Sucursal {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "sucursal";
    
    // Propiedades de la sucursal
    public $idsucursal;
    public $nombre;
    public $estado;
    public $idempresa;
    public $idusuario;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todas las sucursales
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una sucursal por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idsucursal = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idsucursal);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear una nueva sucursal
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, estado, idempresa, idusuario) VALUES (:nombre, :estado, :idempresa, :idusuario)";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idempresa = htmlspecialchars(strip_tags($this->idempresa));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idempresa', $this->idempresa);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar una sucursal
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, estado = :estado, idempresa = :idempresa, idusuario = :idusuario WHERE idsucursal = :idsucursal";
        $stmt = $this->conn->prepare($query);

        $this->idsucursal = htmlspecialchars(strip_tags($this->idsucursal));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idempresa = htmlspecialchars(strip_tags($this->idempresa));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':idsucursal', $this->idsucursal);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idempresa', $this->idempresa);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de una sucursal
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idsucursal = :idsucursal";
        $stmt = $this->conn->prepare($query);

        $this->idsucursal = htmlspecialchars(strip_tags($this->idsucursal));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idsucursal', $this->idsucursal);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
} 
?>
