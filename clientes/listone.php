<?php
include_once '../config/core.php';
include_once 'cliente.php'; // Se incluye el archivo de la clase Cliente

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar objeto cliente
$cliente = new Cliente($db); // Se instancia la clase Cliente

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío y el id_cliente está presente
if ($jwt && isset($data->id_cliente)) {
    // Si el JWT es válido, mostrar detalles del cliente
    try {
        // Establecer el ID del cliente
        $cliente->id_cliente = $data->id_cliente;

        // Obtener los datos del cliente
        $stmt = $cliente->getOne();
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
        "msg"       => "Acceso denegado o falta el ID del cliente"
    );

    echo json_encode($json);
}
?>