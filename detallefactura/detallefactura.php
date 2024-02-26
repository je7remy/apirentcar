<?php
class DetalleFactura {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $detalle_table_name = "detallefactura";
    
    // Propiedades del detalle de factura
    public $idfacturadetalle;
    public $idfactura;
    public $idvehiculo;
    public $monto;
    public $descuento;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todos los detalles de factura
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->detalle_table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un detalle de factura por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->detalle_table_name . " WHERE idfacturadetalle = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idfacturadetalle);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear un nuevo detalle de factura
    function create() {
        $query = "INSERT INTO " . $this->detalle_table_name . " (idfactura, idvehiculo, monto, descuento) VALUES (:idfactura, :idvehiculo, :monto, :descuento)";
        $stmt = $this->conn->prepare($query);

        $this->idfactura = htmlspecialchars(strip_tags($this->idfactura));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));

        $stmt->bindParam(':idfactura', $this->idfactura);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar un detalle de factura
    public function update() {
        $query = "UPDATE " . $this->detalle_table_name . " SET idfactura = :idfactura, idvehiculo = :idvehiculo, monto = :monto, descuento = :descuento WHERE idfacturadetalle = :idfacturadetalle";
        $stmt = $this->conn->prepare($query);

        $this->idfacturadetalle = htmlspecialchars(strip_tags($this->idfacturadetalle));
        $this->idfactura = htmlspecialchars(strip_tags($this->idfactura));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->monto = htmlspecialchars(strip_tags($this->monto));
        $this->descuento = htmlspecialchars(strip_tags($this->descuento));

        $stmt->bindParam(':idfacturadetalle', $this->idfacturadetalle);
        $stmt->bindParam(':idfactura', $this->idfactura);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':descuento', $this->descuento);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar un detalle de factura
    public function delete() {
        $query = "DELETE FROM " . $this->detalle_table_name . " WHERE idfacturadetalle = ?";
        $stmt = $this->conn->prepare($query);

        $this->idfacturadetalle = htmlspecialchars(strip_tags($this->idfacturadetalle));

        $stmt->bindParam(1, $this->idfacturadetalle);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
