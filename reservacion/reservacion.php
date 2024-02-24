<?php
class Reservacion {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "reservacion";
    
    // Propiedades de la reservación
    public $idreservacion;
    public $descripcion;
    public $estado;
    public $fechainicio;
    public $fechafin;
    public $idcliente;
    public $idvehiculo;
    public $monto;
    public $descuento;
    public $idusuario;
    public $fecharegistro;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todas las reservaciones
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una reservación por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idreservacion = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idreservacion);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear una nueva reservación
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion, estado, fechainicio, fechafin, idcliente, idvehiculo, monto, descuento, idusuario, fecharegistro) VALUES (:descripcion, :estado, :fechainicio, :fechafin, :idcliente, :idvehiculo, :monto, :descuento, :idusuario, :fecharegistro)";
        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->fechainicio = htmlspecialchars(strip_tags($this->fechainicio));
        $this->fechafin = htmlspecialchars(strip_tags($this->fechafin));
        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecharegistro = htmlspecialchars(strip_tags($this->fecharegistro));

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fechainicio', $this->fechainicio);
        $stmt->bindParam(':fechafin', $this->fechafin);
        $stmt->bindParam(':idcliente', $this->idcliente);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecharegistro', $this->fecharegistro);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar una reservación
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET descripcion = :descripcion, estado = :estado, fechainicio = :fechainicio, fechafin = :fechafin, idcliente = :idcliente, idvehiculo = :idvehiculo, monto = :monto, descuento = :descuento, idusuario = :idusuario, fecharegistro = :fecharegistro WHERE idreservacion = :idreservacion";
        $stmt = $this->conn->prepare($query);

        $this->idreservacion = htmlspecialchars(strip_tags($this->idreservacion));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->fechainicio = htmlspecialchars(strip_tags($this->fechainicio));
        $this->fechafin = htmlspecialchars(strip_tags($this->fechafin));
        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecharegistro = htmlspecialchars(strip_tags($this->fecharegistro));

        $stmt->bindParam(':idreservacion', $this->idreservacion);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fechainicio', $this->fechainicio);
        $stmt->bindParam(':fechafin', $this->fechafin);
        $stmt->bindParam(':idcliente', $this->idcliente);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecharegistro', $this->fecharegistro);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de una reservación
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idreservacion = :idreservacion";
        $stmt = $this->conn->prepare($query);

        $this->idreservacion = htmlspecialchars(strip_tags($this->idreservacion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idreservacion', $this->idreservacion);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
