<?php 
    class usuario{
        
        // database connection and table name
        private $conn;
        private $table_name = "usuario";
       public $id_usuario;
       public $nombre;
       public $usuario;
       public $clave;
       public $estado;
       public $tipo_usuario;
       public $usuario_registro;
       public $fecha_registro;
       public $usuario_modificado;
       public $fecha_modificado;


 
     
     public $codigousuario ;

     // constructor
    public function __construct($db){
     $this->conn = $db;
     }
     
     
     // GET ALL
     function getAll(){
            $sqlQuery = "SELECT 
       id_usuario,
       nombre,
       usuario,
       clave,
       estado,
       tipo_usuario,
       usuario_registro,
       fecha_registro,
       usuario_modificado,
       fecha_modificado FROM usuario ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ONE
        function getOne(){
           $sqlQuery = "SELECT  
       id_usuario,
       nombre,
       usuario,
       clave,
       estado,
       tipo_usuario,
       usuario_registro,
       fecha_registro,
       usuario_modificado,
       fecha_modificado FROM usuario
           WHERE id_usuario = ". $this->id_usuario ;
           $stmt = $this->conn->prepare($sqlQuery);
           $stmt->execute();
           return $stmt;
       }
    

       // create new  record
       function create(){
           try{
           // insert query
              $query = "INSERT INTO usuario (
       nombre,
       usuario,
       clave,
       estado,
       tipo_usuario,
              usuario_registro,
              fecha_registro) values (
       :nombre,
       :usuario,
       :clave,
       :estado,
       :tipo_usuario ,
               :usuario_registro,
               curdate())";
              
              
           // prepare the query
           $stmt = $this->conn->prepare($query);
       
           // sanitize
           
       $this->nombre=htmlspecialchars(strip_tags($this->nombre));
       $this->usuario=htmlspecialchars(strip_tags($this->usuario));
       $this->clave=htmlspecialchars(strip_tags($this->clave));
       $this->estado=htmlspecialchars(strip_tags($this->estado));
       $this->tipo_usuario=htmlspecialchars(strip_tags($this->tipo_usuario));
       $this->usuario_registro=htmlspecialchars(strip_tags($this->codigousuario)); 


       $stmt->bindParam(':nombre', $this->nombre);
       $stmt->bindParam(':usuario', $this->usuario);
       $stmt->bindParam(':clave', $this->clave);
       $stmt->bindParam(':estado', $this->estado);
       $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
           
           $stmt->bindParam(':usuario_registro', $this->codigousuario);


           // execute the query, also check if query was successful
           if($stmt->execute()){
            
               return true;
           }
           
       }catch(PDOException $exception){
           wh_log( date("y-m-d H:i:s"). " - ".   "Error al insertar datos usuario 5 ".  $table );
           wh_log( $exception   );
           
           
           return false;
       }
       
           return false;
       } 
   // update() method will be here
   // update a  record
   public function update(){
    
       try{
        
       $query = "UPDATE usuario
         SET 
       nombre = :nombre,
       usuario = :usuario,
       clave = :clave,
       estado = :estado,
       tipo_usuario = :tipo_usuario,
       usuario_registro = :usuario_registro,
       fecha_registro = :fecha_registro,
       usuario_modificado = :usuario_modificado,
       fecha_modificado = :fecha_modificado ,
       usuario_modificado = :usuario_modificado,
       fecha_modificado = curdate()
               WHERE id_usuario = :id_usuario";
                  
       // prepare the query
       $stmt = $this->conn->prepare($query);
       
      
       $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
       $this->nombre=htmlspecialchars(strip_tags($this->nombre));
       $this->usuario=htmlspecialchars(strip_tags($this->usuario));
       $this->clave=htmlspecialchars(strip_tags($this->clave));
       $this->estado=htmlspecialchars(strip_tags($this->estado));
       $this->tipo_usuario=htmlspecialchars(strip_tags($this->tipo_usuario));
       $this->usuario_registro=htmlspecialchars(strip_tags($this->usuario_registro));
       $this->fecha_registro=htmlspecialchars(strip_tags($this->fecha_registro));
       $this->usuario_modificado=htmlspecialchars(strip_tags($this->usuario_modificado));
       $this->fecha_modificado=htmlspecialchars(strip_tags($this->fecha_modificado));
      $this->usuario_modificado=htmlspecialchars(strip_tags($this->codigousuario));
         
       // bind the values
      
       $stmt->bindParam(':id_usuario', $this->id_usuario);
       $stmt->bindParam(':nombre', $this->nombre);
       $stmt->bindParam(':usuario', $this->usuario);
       $stmt->bindParam(':clave', $this->clave);
       $stmt->bindParam(':estado', $this->estado);
       $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
       $stmt->bindParam(':usuario_registro', $this->usuario_registro);
       $stmt->bindParam(':fecha_registro', $this->fecha_registro);
       $stmt->bindParam(':usuario_modificado', $this->usuario_modificado);
       $stmt->bindParam(':fecha_modificado', $this->fecha_modificado); 
      $stmt->bindParam(':usuario_modificado', $this->codigousuario);

       // execute the query
       if($stmt->execute()){
           return true;
       }
       
   }catch(PDOException $exception){
       wh_log( date("y-m-d H:i:s"). " - ".   "Error al insertar datos usuario 5 " );
       wh_log( $exception   );
       
       
       return false;
   }
       return false;
   }
   
   
   
public function updateestado(){
  
  
  $query = "UPDATE usuario
          SET  
          estado =:estado 
          WHERE id_usuario = :id_usuario"; 
          
  // prepare the query 
  $stmt = $this->conn->prepare($query); 
  
  // sanitize 
  $this-> estado=htmlspecialchars(strip_tags($this-> estado)); 
   
  
  // bind the values 
  $stmt->bindParam(':estado', $this->estado); 
  // unique ID of record to be edited 
  $stmt->bindParam(':id_usuario', $this->id_usuario); 
  
  // execute the query 
  if($stmt->execute()){ 
      return true; 
  } 
  
  return false; 
} 
} 
?> 
 
   