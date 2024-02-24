<?php
include_once '../config/core.php';
include_once 'vehiculo.php'; // Se cambió la inclusión del archivo

// Obtener la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar un objeto vehículo
$vehiculo = new Vehiculo($db); // Cambio en la instancia del objeto

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener el JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, mostrar detalles del vehículo
    try {
        // Obtener todos los registros de vehículos
        $stmt = $vehiculo->getAll();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
