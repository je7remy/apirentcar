<?php

include_once '../config/core.php';
include_once 'sucursal.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar el objeto sucursal
$sucursal = new Sucursal($db);

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener el JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, actualizar el estado de la sucursal
    try {
        // Establecer los valores de propiedad de la sucursal
        $sucursal->idsucursal = $data->idsucursal;
        $sucursal->estado = $data->estado;

        // Actualizar el estado de la sucursal
        $result = $sucursal->updateEstado();

        // Si se actualizó correctamente
        if ($result) {
            // Establecer el código de respuesta
            http_response_code(200);

            $json = array(
                "status"    => "true",
                "errcode"   => "01",
                "msg"       => "Datos procesados correctamente"
            );

            // Respuesta en formato JSON
            echo json_encode($json);
        } else {
            // Establecer el código de respuesta
            http_response_code(200);

            // Mostrar mensaje de error
            $json = array(
                "status"    => "true",
                "errCode"   => "00",
                "msg"       => "Error al actualizar el estado de la sucursal"
            );
            echo json_encode($json);	
        }
    } catch (Exception $e) {
        // Establecer el código de respuesta
        http_response_code(200);

        $json = array(
            "status"    => "true",
            "errCode"   => "05",
            "msg"       => "Acceso denegado"
        );

        echo json_encode($json);
    }
} else {
    // Establecer el código de respuesta
    http_response_code(200);

    // Indicar que el acceso está denegado
    $json = array(
        "status"    => "true",
        "errCode"   => "00",
        "msg"       => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
