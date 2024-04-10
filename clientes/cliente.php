<?php
class Cliente {
        
    // Conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "clientes";
    
    // Propiedades del cliente
    public $id_cliente;
    public $nombre;
    public $apellido;
    public $sexo;
    public $whatsapp;
    public $correo;
    public $telefonol;
    public $telefono2;
    public $estado;
    public $tipo_identificacion;
    public $numero_identificacion;
    public $usuario_registro;
    public $fecha_registro;
    public $usuario_modificado;
    public $fecha_modificado;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Obtener todos los clientes
    function getAll() {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un cliente por su ID
    function getOne() {
        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id_cliente);
        $stmt->execute();
        return $stmt;
    }
    
    // Crear un nuevo cliente
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, sexo, whatsapp, correo, telefonol, telefono2, estado, tipo_identificacion, numero_identificacion, usuario_registro, fecha_registro, usuario_modificado, fecha_modificado) VALUES (:nombre, :apellido, :sexo, :whatsapp, :correo, :telefonol, :telefono2, :estado, :tipo_identificacion, :numero_identificacion, :usuario_registro, :fecha_registro, :usuario_modificado, :fecha_modificado)";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        $this->whatsapp = htmlspecialchars(strip_tags($this->whatsapp));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->telefonol = htmlspecialchars(strip_tags($this->telefonol));
        $this->telefono2 = htmlspecialchars(strip_tags($this->telefono2));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->tipo_identificacion = htmlspecialchars(strip_tags($this->tipo_identificacion));
        $this->numero_identificacion = htmlspecialchars(strip_tags($this->numero_identificacion));
        $this->usuario_registro = htmlspecialchars(strip_tags($this->usuario_registro));
        $this->fecha_registro = htmlspecialchars(strip_tags($this->fecha_registro));
        $this->usuario_modificado = htmlspecialchars(strip_tags($this->usuario_modificado));
        $this->fecha_modificado = htmlspecialchars(strip_tags($this->fecha_modificado));

        // Asignar valores a los parámetros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':whatsapp', $this->whatsapp);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':telefonol', $this->telefonol);
        $stmt->bindParam(':telefono2', $this->telefono2);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':tipo_identificacion', $this->tipo_identificacion);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion);
        $stmt->bindParam(':usuario_registro', $this->usuario_registro);
        $stmt->bindParam(':fecha_registro', $this->fecha_registro);
        $stmt->bindParam(':usuario_modificado', $this->usuario_modificado);
        $stmt->bindParam(':fecha_modificado', $this->fecha_modificado);

        // Ejecutar consulta
        if($stmt->execute()) {
            return true;
        }
        return false;
    } 
    public function update(){

        try{
    
            $query = "UPDATE clientes
              SET  
              nombre = :nombre,
              apellido = :apellido,
              sexo = :sexo,
              whatsapp = :whatsapp,
              correo = :correo,
              telefonol = :telefonol,
              telefono2 = :telefono2,
              estado = :estado,
              tipo_identificacion = :tipo_identificacion,
              numero_identificacion = :numero_identificacion,
              usuario_registro = :usuario_registro,
              fecha_registro = :fecha_registro,
              usuario_modificado = :usuario_modificado,
              fecha_modificado = curdate()
              WHERE id_cliente = :id_cliente";
    
            // prepare the query
            $stmt = $this->conn->prepare($query);
    
            $this->id_cliente=htmlspecialchars(strip_tags($this->id_cliente));
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->apellido=htmlspecialchars(strip_tags($this->apellido));
            $this->sexo=htmlspecialchars(strip_tags($this->sexo));
            $this->whatsapp=htmlspecialchars(strip_tags($this->whatsapp));
            $this->correo=htmlspecialchars(strip_tags($this->correo));
            $this->telefonol=htmlspecialchars(strip_tags($this->telefonol));
            $this->telefono2=htmlspecialchars(strip_tags($this->telefono2));
            $this->estado=htmlspecialchars(strip_tags($this->estado));
            $this->tipo_identificacion=htmlspecialchars(strip_tags($this->tipo_identificacion));
            $this->numero_identificacion=htmlspecialchars(strip_tags($this->numero_identificacion));
            $this->usuario_registro=htmlspecialchars(strip_tags($this->usuario_registro));
            $this->fecha_registro=htmlspecialchars(strip_tags($this->fecha_registro));
            $this->usuario_modificado=htmlspecialchars(strip_tags($this->usuario_modificado));
    
            // bind the values
            $stmt->bindParam(':id_cliente', $this->id_cliente);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':whatsapp', $this->whatsapp);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':telefonol', $this->telefonol);
            $stmt->bindParam(':telefono2', $this->telefono2);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipo_identificacion', $this->tipo_identificacion);
            $stmt->bindParam(':numero_identificacion', $this->numero_identificacion);
            $stmt->bindParam(':usuario_registro', $this->usuario_registro);
            $stmt->bindParam(':fecha_registro', $this->fecha_registro);
            $stmt->bindParam(':usuario_modificado', $this->usuario_modificado);
    
            // execute the query
            if($stmt->execute()){
                return true;
            }
    
        }catch(PDOException $exception){
            wh_log( date("y-m-d H:i:s"). " - ".   "Error al insertar datos cliente 5 " );
            wh_log( $exception   );
    
            return false;
        }
    
        return false;
    }
    
    public function updateestado(){
    
    $query = "UPDATE clientes
              SET  
              estado =:estado 
              WHERE id_cliente = :id_cliente"; 
    
      // prepare the query 
      $stmt = $this->conn->prepare($query); 
    
      // sanitize 
      $this->estado=htmlspecialchars(strip_tags($this->estado)); 
    
      // bind the values 
      $stmt->bindParam(':estado', $this->estado); 
      // unique ID of record to be edited 
      $stmt->bindParam(':id_cliente', $this->id_cliente); 
    
      // execute the query 
      if($stmt->execute()){ 
          return true; 
      }
    
      return false; 
    }
}


?>
