<?php

include_once '../config/core.php';
include_once 'detallefactura.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar el objeto DetalleFactura
$detalleFactura = new DetalleFactura($db);

// Obtener los datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener el JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si el JWT es válido, actualizar el estado del detalle de la factura
    try {
        // Establecer los valores de propiedad del detalle de la factura
        $detalleFactura->idfacturadetalle = $data->idfacturadetalle;
        $detalleFactura->estado = $data->estado;

        // Actualizar el estado del detalle de la factura
        $success = $detalleFactura->updateEstado();

        // Si se actualizó correctamente
        if ($success) {
            // Establecer el código de respuesta
            http_response_code(200);

            $json = array(
                "status"    => "true",
                "errcode"   => "01",
                "msg"       => "Estado del detalle de la factura actualizado correctamente"
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
                "msg"       => "Error al actualizar el estado del detalle de la factura"
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
