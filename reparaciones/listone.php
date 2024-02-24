<?php
include_once '../config/core.php';
include_once 'reparacion.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar el objeto reparacion
$reparacion = new Reparacion($db);

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener el JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, mostrar los detalles de la reparacion
    try {
        // Establecer el ID de la reparacion
        $reparacion->idreparacion = $data->idreparacion;

        // Obtener los datos de la reparacion
        $stmt = $reparacion->getOne();
        $itemCount = $stmt->rowCount();

        // Si se encontraron datos
        if ($itemCount > 0) {
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            // Establecer el código de respuesta
            http_response_code(200);

            $json = array(
                "status"    => "true",
                "errcode"   => "01",
                "msg"       => "Datos procesados",
                "data"      => $datos
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
                "msg"       => "No existen datos"
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
