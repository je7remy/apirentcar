<?php 
    class reporte{
        
        // database connection and table name
        private $conn;
        private $table_name = "clientes";
    public $id_cliente;
  
    public $estado;


     // constructor
    public function __construct($db){
     $this->conn = $db;
     }
     
     
 /*    // GET ALL
             function getAllusuario(){
            $sqlQuery = "SELECT 
       id_usuario,
       nombre FROM usuario where tipo_usuario = 'ADM' union SELECT 
      0 as id_usuario,
      'Todos' as nombre";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }*/
        
/*
// GET ALL
function getAllcliente(){
    $sqlQuery =  "SELECT 
       id_cliente,
       nombre FROM clientes where estado = 'activo' union SELECT 
      0 as id_cliente,
      'Todos' as nombre";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
}
*/




    /* // GET ALL d
             function getAllcliente(){
            $sqlQuery = "SELECT 
       id_cliente,
       nombre FROM clientes  union SELECT 
      0 as id_cliente,
      'Todos' as nombre";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }*/

      function getAllcliente(){
    $sqlQuery = "SELECT 
        id_cliente,
        nombre,
        apellido,
        sexo,
        whatsapp,
        correo,
        telefonol,
        telefono2,
        estado,
        tipo_identificacion,
        numero_identificacion,
        usuario_registro,
        fecha_registro,
        usuario_modificado,
        fecha_modificado
    FROM clientes
    UNION
    SELECT
        0 as id_cliente,
        'Todos' as nombre,
        '' as apellido,
        '' as sexo,
        '' as whatsapp,
        '' as correo,
        '' as telefonol,
        '' as telefono2,
        '' as estado,
        '' as tipo_identificacion,
        '' as numero_identificacion,
        '' as usuario_registro,
        '' as fecha_registro,
        '' as usuario_modificado,
        '' as fecha_modificado";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
}

         /*  // GET ONE
        function getrepusuario(){
           $sqlQuery = "SELECT id_usuario, nombre, usuario, clave, tipo, CASE
            WHEN estado = 'A' THEN 'Activa'
            WHEN estado = 'I' THEN 'Inactiva'
        END estado 
          FROM usuario 
       where  (". $this->id_usuario." = 0 or id_usuario  = ". $this->id_usuario.") 
       and ('". $this->estado."' = '%' or estado  = '". $this->estado."')" ;*/
        
  // GET ONE
        function getrepcliente(){
           $sqlQuery = "SELECT id_cliente, nombre, apellido, sexo, whatsapp, 	
correo,	
telefonol,	
telefono2,	
 CASE
            WHEN estado = 'A' THEN 'activo'
            WHEN estado = 'I' THEN 'inactivo'
        END estado,
estado,	
tipo_identificacion,
numero_identificacion,	
usuario_registro,	
fecha_registro,	
usuario_modificado,
fecha_modificado
          
          FROM clientes 
       where  (". $this->id_cliente." = 0 or id_cliente  = ". $this->id_cliente.") 
       and ('". $this->estado."' = '%' or estado  = '". $this->estado."')" ;

           $stmt = $this->conn->prepare($sqlQuery);
           $stmt->execute();
           return $stmt;
       }
    



     
} 
?> 
 
   