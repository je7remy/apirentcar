<?php
include_once '../config/core.php';
include_once 'gasto.php'; // Se incluye el archivo de la clase Gasto

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
use \Firebase\JWT\JWT;

// Instanciar objeto gasto (en lugar de ingreso)
$gasto = new Gasto($db); // Se instancia la clase Gasto

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si la decodificación es exitosa, mostrar detalles del gasto
    try {
        // Establecer los valores de las propiedades del gasto
        $gasto->idgastos = $data->idgastos;
        $gasto->descripcion = $data->descripcion;
        $gasto->monto = $data->monto;
        $gasto->estado = $data->estado;
        $gasto->idusuario = $data->idusuario;
        $gasto->fecha = $data->fecha;

        // Actualizar el gasto
        $success = $gasto->update();

        // Si se actualizó correctamente
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
                "msg"       => "Error al actualizar datos del gasto"
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
            "errCode"   => "00",
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
        "errCode"   => "05",
        "msg"       => "Acceso denegado"
    );

    echo json_encode($json);
}
?>
