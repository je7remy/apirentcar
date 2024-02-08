<?php
    //agregar usuario
    include_once '../config/core.php';
    include_once 'usuario.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    use \Firebase\JWT\JWT; 
    // instantiate  object
    $datos = new usuario($db);
     
    // retrieve given jwt here
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
     
    // decode jwt here
    // if jwt is not empty
    if($jwt){
     
        // if decode succeed, show datos details
        try {
     
          
     
            // set datos property values
       
       $datos->nombre = $data->nombre;
       $datos->usuario = $data->usuario;
       $datos->clave = $data->clave;
       $datos->estado = $data->estado;
       $datos->tipo_usuario = $data->tipo_usuario;
    
       $datos->codigousuario = $data->usuario_registro;
     
        // update datos will be here
        
    
             $dat = $datos->create();
        // update the datos record
    
    
        if($dat){
        
            // set response code
            http_response_code(200);
    
            $json = array(
              "status" 	=> "true",
              "errcode"	=> "01",
              "msg"		=> "Datos procesados correctamente"
              );
             
            // response in json format
            echo json_encode($json );
        }
         
        // message if unable to update datos
        else{
            // set response code
            http_response_code(200);
         
            // show error message
              $json = array(
            "status" 	=> "true",
            "errCode" 	=> "00",
            "msg" 		=> "Error al insertar datos 'usuario'"
            );
            echo json_encode($json);	
        }
        }
     
        // if decode fails, it means jwt is invalid
    catch (Exception $e){
     
        // set response code
        http_response_code(200);
    
      $json = array(
        "status" 	=> "true",
        "errCode" 	=> "05",
        "msg" 		=> "Acceso denegado"
        );
        
      echo json_encode($json);
    }
    }
     // show error message if jwt is empty
    else{
     
        // set response code
        http_response_code(200);
     
        // tell the datos access denied
      $json = array(
        "status" 	=> "true",
        "errCode" 	=> "00",
        "msg" 		=> "Acceso denegado"
        );
      
        echo json_encode($json);
    }
    ?>