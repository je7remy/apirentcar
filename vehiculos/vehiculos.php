<?php
class Vehiculo {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "vehiculos";
    
    // Propiedades del vehículo
    public $idvehiculo;
    public $marca;
    public $nombre;
    public $descripcion;
    public $estado;
    public $chasis;
    public $color;
    public $combustible;
    public $modelo;
    public $ultimomantenimiento;
    public $seguro;
    public $idusuario;
    public $fecha;
    public $segurovence;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todos los vehículos
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un vehículo por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE idvehiculo = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->idvehiculo);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear un nuevo vehículo
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (marca, nombre, descripcion, estado, chasis, color, combustible, modelo, ultimomantenimiento, seguro, idusuario, fecha, segurovence) VALUES (:marca, :nombre, :descripcion, :estado, :chasis, :color, :combustible, :modelo, :ultimomantenimiento, :seguro, :idusuario, :fecha, :segurovence)";
        $stmt = $this->conn->prepare($query);

        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->chasis = htmlspecialchars(strip_tags($this->chasis));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->combustible = htmlspecialchars(strip_tags($this->combustible));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->ultimomantenimiento = htmlspecialchars(strip_tags($this->ultimomantenimiento));
        $this->seguro = htmlspecialchars(strip_tags($this->seguro));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->segurovence = htmlspecialchars(strip_tags($this->segurovence));

        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':chasis', $this->chasis);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':combustible', $this->combustible);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':ultimomantenimiento', $this->ultimomantenimiento);
        $stmt->bindParam(':seguro', $this->seguro);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':segurovence', $this->segurovence);

        if($stmt->execute()) {
            return true;
        }
        return false;
    } 

    // Actualizar un vehículo
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET marca = :marca, nombre = :nombre, descripcion = :descripcion, estado = :estado, chasis = :chasis, color = :color, combustible = :combustible, modelo = :modelo, ultimomantenimiento = :ultimomantenimiento, seguro = :seguro, idusuario = :idusuario, fecha = :fecha, segurovence = :segurovence WHERE idvehiculo = :idvehiculo";
        $stmt = $this->conn->prepare($query);

        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->chasis = htmlspecialchars(strip_tags($this->chasis));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->combustible = htmlspecialchars(strip_tags($this->combustible));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->ultimomantenimiento = htmlspecialchars(strip_tags($this->ultimomantenimiento));
        $this->seguro = htmlspecialchars(strip_tags($this->seguro));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->segurovence = htmlspecialchars(strip_tags($this->segurovence));

        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':chasis', $this->chasis);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':combustible', $this->combustible);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':ultimomantenimiento', $this->ultimomantenimiento);
        $stmt->bindParam(':seguro', $this->seguro);
        $stmt->bindParam(':idusuario', $this->idusuario);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':segurovence', $this->segurovence);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar el estado de un vehículo
    public function updateEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE idvehiculo = :idvehiculo";
        $stmt = $this->conn->prepare($query);

        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
} 
?>
