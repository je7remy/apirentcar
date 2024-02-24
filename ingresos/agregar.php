<?php
include_once '../config/core.php';
include_once 'ingreso.php'; // Se incluye el archivo de la clase Ingreso

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar objeto ingreso (en lugar de reparacion)
$ingreso = new Ingreso($db); // Se instancia la clase Ingreso

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, mostrar detalles del ingreso
    try {
        // Establecer los valores de las propiedades de datos
        $ingreso->descripcion = $data->descripcion;
        $ingreso->monto = $data->monto;
        $ingreso->estado = $data->estado;
        $ingreso->tipo = $data->tipo;
        $ingreso->idusuario = $data->idusuario;
        $ingreso->fecha = $data->fecha;

        // Insertar datos
        $success = $ingreso->create(); // Se llama al método create() de la clase Ingreso

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
                "msg"       => "Error al insertar datos del ingreso"
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
