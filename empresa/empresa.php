<?php
class Empresa {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "empresa";
    
    // Propiedades de la empresa
    public $idempresa;
    public $nombre;
    public $estado;
    public $idusuario;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todas las empresas
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una empresa por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idempresa = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idempresa);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear una nueva empresa
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, estado, idusuario) VALUES (:nombre, :estado, :idusuario)";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar una empresa
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, estado = :estado, idusuario = :idusuario WHERE idempresa = :idempresa";
        $stmt = $this->conn->prepare($query);

        $this->idempresa = htmlspecialchars(strip_tags($this->idempresa));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':idempresa', $this->idempresa);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar una empresa
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE idempresa = ?";
        $stmt = $this->conn->prepare($query);

        $this->idempresa = htmlspecialchars(strip_tags($this->idempresa));

        $stmt->bindParam(1, $this->idempresa);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
