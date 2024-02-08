<?php

include_once '../config/core.php';
include_once 'dashboard.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
$dashboard = new Dashboard($db);




// retrieve given jwt here
// get posted data
// $data = json_decode(file_get_contents("php://input"));  

// get jwt
// $jwt=isset($data->jwt) ? $data->jwt : "";
//  $dashboard->id_cliente = $data->id_cliente;

$jwt = true;

$datos = $dashboard->dash();



// decode jwt here
// if jwt is not empty
if ($jwt) {

    // if decode succeed, show datos details
    try {

        // decode jwt


        if ($datos) {
            http_response_code(200);
            echo json_encode(
                array(
                    "status" => true,
                    "monto1" => $dashboard->monto1,
                    "cantidadcitas" => $dashboard->cantidadcitas,
                    "cantidadconsultas" => $dashboard->cantidadconsultas,
                    "cantidadcitasvencidas" => $dashboard->cantidadcitasvencidas ,
                    "tblcitas" => $dashboard->tblcitas,
                    "tblconsultas" => $dashboard->tblconsultas
                )
            );
        }

        // login failed will be here
        // login failed
        else {

            // set response code
            http_response_code(200);

            // show error message
            $json = array(
                'status'     => false,
                'errCode'     => '00',
                'msg'         => 'Datos no encontrados'
            );
            echo json_encode($json);
        }
    }

    // if decode fails, it means jwt is invalid
    catch (Exception $e) {

        // set response code
        http_response_code(200);

        $json = array(
            "status"     => false,
            "errCode"     => "05",
            "msg"         => "Acceso denegado"
        );
        echo json_encode($json);
    }
}
// show error message if jwt is empty
else {

    // set response code
    http_response_code(200);

    // tell the datos access denied
    $json = array(
        "status"     => false,
        "errCode"     => "00",
        "msg"         => "Acceso denegado"
    );
    echo json_encode($json);
}
