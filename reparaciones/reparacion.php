<?php
class Reparacion {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "reparaciones";
    
    // Propiedades de la reparación
    public $idreparacion;
    public $descripcion;
    public $idvehiculo;
    public $fecha;
    public $idusuario;
    public $estado;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todas las reparaciones
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una reparación por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idreparacion = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idreparacion);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear una nueva reparación
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion, idvehiculo, fecha, idusuario, estado) VALUES (:descripcion, :idvehiculo, :fecha, :idusuario, :estado)";
        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':estado', $this->estado);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar una reparación
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET descripcion = :descripcion, idvehiculo = :idvehiculo, fecha = :fecha, idusuario = :idusuario, estado = :estado WHERE idreparacion = :idreparacion";
        $stmt = $this->conn->prepare($query);

        $this->idreparacion = htmlspecialchars(strip_tags($this->idreparacion));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':idreparacion', $this->idreparacion);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':estado', $this->estado);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de una reparación
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idreparacion = :idreparacion";
        $stmt = $this->conn->prepare($query);

        $this->idreparacion = htmlspecialchars(strip_tags($this->idreparacion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idreparacion', $this->idreparacion);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
