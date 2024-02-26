<?php
class Gasto {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "gastos";
    
    // Propiedades del gasto
    public $idgastos;
    public $descripcion;
    public $monto;
    public $estado;
    public $idusuario;
    public $fecha;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todos los gastos
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un gasto por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idgasto = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idgastos);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear un nuevo gasto
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion, monto, estado, idusuario, fecha) VALUES (:descripcion, :monto, :estado, :idusuario, :fecha)";
        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar un gasto
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET descripcion = :descripcion, monto = :monto, estado = :estado, idusuario = :idusuario, fecha = :fecha WHERE idgasto = :idgasto";
        $stmt = $this->conn->prepare($query);

        $this->idgastos = htmlspecialchars(strip_tags($this->idgastos));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(':idgasto', $this->idgastos);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de un gasto
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idgasto = :idgasto";
        $stmt = $this->conn->prepare($query);

        $this->idgastos = htmlspecialchars(strip_tags($this->idgastos));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idgasto', $this->idgastos);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
