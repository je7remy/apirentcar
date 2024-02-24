<?php
include_once '../config/core.php';
include_once 'reparacion.php'; // Se incluye el archivo de la clase Reparacion

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// Instanciar objeto reparacion (en lugar de reservacion)
$reparacion = new Reparacion($db); // Se instancia la clase Reparacion

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, mostrar detalles de la reparacion
    try {
        // Establecer los valores de las propiedades de datos
        $reparacion->descripcion = $data->descripcion;
        $reparacion->idvehiculo = $data->idvehiculo;
        $reparacion->fecha = $data->fecha;
        $reparacion->idusuario = $data->idusuario;
        $reparacion->estado = $data->estado;

        // Insertar datos
        $success = $reparacion->create(); // Se llama al método create() de la clase Reparacion

        // Si se insertaron correctamente
        if ($success) {
            // Establecer código de respuesta
            http_response_code(200);

            $json = array(
                "status"    => "true",
                "errcode"   => "01",
                "msg"       => "Datos procesados correctamente"
            );

            // Respuesta en formato JSON
            echo json_encode($json);
        } else {
            // Establecer código de respuesta
            http_response_code(200);

            // Mostrar mensaje de error
            $json = array(
                "status"    => "true",
                "errCode"   => "00",
                "msg"       => "Error al insertar datos de la reparacion"
            );
            echo json_encode($json);
        }
    }
    // Si la decodificación falla, significa que el JWT no es válido
    catch (Exception $e) {
        // Establecer código de respuesta
        http_response_code(200);

        $json = array(
            "status"    => "true",
            "errCode"   => "05",
            "msg"       => "Acceso denegado"
        );

        echo json_encode($json);
    }
}
// Mostrar mensaje de error si el JWT está vacío
else {
    // Establecer código de respuesta
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
