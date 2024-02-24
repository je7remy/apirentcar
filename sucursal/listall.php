<?php
include_once '../config/core.php';
include_once 'sucursal.php'; // Cambio en la inclusión del archivo

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate objeto sucursal
$sucursal = new Sucursal($db); // Cambio en la instancia del objeto

// obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// si el JWT no está vacío
if ($jwt) {
    // si el JWT es válido, mostrar detalles de la sucursal
    try {
        // update the datos record
        $stmt = $sucursal->getAll();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // establecer el código de respuesta
            http_response_code(200);

            $json = array(
                "status"    => "true",
                "errcode"   => "01",
                "msg"       => "Datos procesados",
                "data"      => $datos
            );

            // respuesta en formato JSON
            echo json_encode($json);
        } else {
            // establecer el código de respuesta
            http_response_code(200);

            // mostrar mensaje de error
            $json = array(
                "status"    => "true",
                "errCode"   => "00",
                "msg"       => "No existen datos"
            );

            echo json_encode($json);
        }
    } catch (Exception $e) {
        // establecer el código de respuesta
        http_response_code(200);

        $json = array(
            "status"    => "true",
            "errCode"   => "05",
            "msg"       => "Acceso denegado"
        );

        echo json_encode($json);
    }
} else {
    // establecer el código de respuesta
    http_response_code(200);

    // decir que el acceso está denegado
    $json = array(
        "status"    => "true",
        "errCode"   => "00",
        "msg"       => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
