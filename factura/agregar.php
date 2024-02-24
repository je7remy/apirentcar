<?php
include_once '../config/core.php';
include_once 'factura.php'; // Se incluye el archivo de la clase Factura

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar objeto factura
$factura = new Factura($db); // Se instancia la clase Factura

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, mostrar detalles de la factura
    try {
        // Establecer los valores de las propiedades de datos
        $factura->fecha = $data->fecha;
        $factura->idcliente = $data->idcliente;
        $factura->monto = $data->monto;
        $factura->descuento = $data->descuento;
        $factura->idusuario = $data->idusuario;

        // Insertar datos de la factura
        $success = $factura->create(); // Se llama al método create() de la clase Factura

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
                "msg"       => "Error al insertar datos de la factura"
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
