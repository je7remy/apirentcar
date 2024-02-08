<?php
// 'user' object
class User {
 
    private $conn;
    private $TUsuario = "usuario";
    public $idusuario;
    public $nombre;
    public $usuario;
    public $clave;
    public $estado;
    public $tipo;
  
    public function __construct($db){
        $this->conn = $db;
    }
 
    public function usuarioExists() {
        $query = "SELECT idusuario, nombre, usuario, clave, estado, tipo FROM " . $this->TUsuario . " 
                  WHERE usuario = ? AND estado = 'A' LIMIT 0,1";
 
        $stmt = $this->conn->prepare($query);
 
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
 
        $stmt->bindParam(1, $this->usuario);
    
        $stmt->execute();
 
        $num = $stmt->rowCount();
    
        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            $this->idusuario = $row['idusuario'];
            $this->nombre = $row['nombre'];
            $this->tipo = $row['tipo'];
            $this->clave = $row['clave'];
            return true;
        }
 
        return false;
    }
}
