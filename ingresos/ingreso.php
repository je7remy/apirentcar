<?php
class Ingreso {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "ingresos";
    
    // Propiedades del ingreso
    public $idingreso;
    public $descripcion;
    public $monto;
    public $estado;
    public $tipo;
    public $idusuario;
    public $fecha;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todos los ingresos
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un ingreso por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idingreso = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idingreso);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear un nuevo ingreso
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion, monto, estado, tipo, idusuario, fecha) VALUES (:descripcion, :monto, :estado, :tipo, :idusuario, :fecha)";
        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar un ingreso
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET descripcion = :descripcion, monto = :monto, estado = :estado, tipo = :tipo, idusuario = :idusuario, fecha = :fecha WHERE idingreso = :idingreso";
        $stmt = $this->conn->prepare($query);

        $this->idingreso = htmlspecialchars(strip_tags($this->idingreso));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(':idingreso', $this->idingreso);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de un ingreso
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idingreso = :idingreso";
        $stmt = $this->conn->prepare($query);

        $this->idingreso = htmlspecialchars(strip_tags($this->idingreso));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idingreso', $this->idingreso);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
