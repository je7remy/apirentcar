<?php
include_once '../config/core.php';
include_once 'user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values
$user->usuario = $data->codusuario;

// check if user exists
$usuario_exists = $user->usuarioExists();

// check if user exists and if password is correct
if($usuario_exists){
    // set password property
    $password =  $data->codclave;
  
    if ($user->clave ==  $password ) {
        // set response code
        http_response_code(200);
        
    // $jwt = JWT::encode($token, $key);
//        $jwt,
        echo json_encode(
            array(
                "status" => true,
                "jwt" => "1",
                "id_usuario" => $user->id_usuario,
                "nombre" => $user->nombre,
                "tipo_usuario" => $user->tipo_usuario
            )
        );
    } else {
        // set response code
        http_response_code(200);
                
        // show error message
        $json = array(
            'status' 	=> false,
            'errCode' 	=> '1',
            'msg' 		=> 'Usuario o clave no registrados'
        );
        echo json_encode($json);	
    }
} else {
    // set response code
    http_response_code(200);
		 
    // show error message
    $json = array(
        'status' 	=> false,
        'errCode' 	=> '2',
        'msg' 		=> 'Usuario o clave no registrados'
    );
    echo json_encode($json);	
}
?>
