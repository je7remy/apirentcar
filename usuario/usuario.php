<?php 
class usuario {
        
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
    public $id_usuario;
    public $nombre;
    public $usuario;
    public $clave;
    public $estado;
    public $tipo_usuario;

    // constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // GET ALL
    function getAll() {
        $sqlQuery = "SELECT 
            id_usuario,
            nombre,
            usuario,
            clave,
            estado,
            tipo_usuario
            FROM usuario";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // create new record
    function create() {
        try {
            $query = "INSERT INTO usuario (
                nombre,
                usuario,
                clave,
                estado,
                tipo_usuario)
                values (
                :nombre,
                :usuario,
                :clave,
                :estado,
                :tipo_usuario)";
              
            $stmt = $this->conn->prepare($query);

            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->usuario = htmlspecialchars(strip_tags($this->usuario));
            $this->clave = htmlspecialchars(strip_tags($this->clave));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));

            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':clave', $this->clave);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);

            if($stmt->execute()) {
                return true;
            }
        } catch(PDOException $exception) {
            // Log error
            return false;
        }
        return false;
    } 

    // update a record
    public function update() {
        try {
            $query = "UPDATE usuario
                SET 
                nombre = :nombre,
                usuario = :usuario,
                clave = :clave,
                estado = :estado,
                tipo_usuario = :tipo_usuario
                WHERE id_usuario = :id_usuario";
                  
            $stmt = $this->conn->prepare($query);

            $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->usuario = htmlspecialchars(strip_tags($this->usuario));
            $this->clave = htmlspecialchars(strip_tags($this->clave));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));

            $stmt->bindParam(':id_usuario', $this->id_usuario);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':clave', $this->clave);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);

            if($stmt->execute()) {
                return true;
            }
        } catch(PDOException $exception) {
            // Log error
            return false;
        }
        return false;
    }

    public function updateestado() {
        $query = "UPDATE usuario
            SET  
            estado = :estado 
            WHERE id_usuario = :id_usuario"; 
        $stmt = $this->conn->prepare($query); 
        $this->estado = htmlspecialchars(strip_tags($this->estado)); 

        $stmt->bindParam(':estado', $this->estado); 
        $stmt->bindParam(':id_usuario', $this->id_usuario); 

        if($stmt->execute()) { 
            return true; 
        } 
        return false; 
    } 
}
?> 
