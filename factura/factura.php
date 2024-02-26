<?php
class Factura {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "factura";
    
    // Propiedades de la factura
    public $idfactura;
    public $fecha;
    public $idcliente;
    public $monto;
    public $descuento;
    public $idusuario;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todas las facturas
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una factura por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idfactura = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idfactura);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear una nueva factura
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (fecha, idcliente, monto, descuento, idusuario) VALUES (:fecha, :idcliente, :monto, :descuento, :idusuario)";
        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':idcliente', $this->idcliente);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar una factura
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET fecha = :fecha, idcliente = :idcliente, monto = :monto, descuento = :descuento, idusuario = :idusuario WHERE idfactura = :idfactura";
        $stmt = $this->conn->prepare($query);

        $this->idfactura = htmlspecialchars(strip_tags($this->idfactura));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(':idfactura', $this->idfactura);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':idcliente', $this->idcliente);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);
        $stmt->bindParam(':idusuario', $this->idusuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el monto de una factura
    public function updateMonto() {
        $query = "UPDATE " . $this->table_name . " SET monto = :monto WHERE idfactura = :idfactura";
        $stmt = $this->conn->prepare($query);

        $this->idfactura = htmlspecialchars(strip_tags($this->idfactura));
        $this->monto = htmlspecialchars(strip_tags($this->monto));

        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':idfactura', $this->idfactura);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
