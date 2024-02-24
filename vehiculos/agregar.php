<?php
// Agregar vehículo
include_once '../config/core.php';
include_once 'vehiculo.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar objeto vehículo
$vehiculo = new Vehiculo($db);

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT enviado
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si la decodificación es exitosa, mostrar detalles del vehículo
    try {
        // Establecer los valores de las propiedades de datos
        $vehiculo->marca = $data->marca;
        $vehiculo->nombre = $data->nombre;
        $vehiculo->descripcion = $data->descripcion;
        $vehiculo->estado = $data->estado;
        $vehiculo->chasis = $data->chasis;
        $vehiculo->color = $data->color;
        $vehiculo->combustible = $data->combustible;
        $vehiculo->modelo = $data->modelo;
        $vehiculo->ultimomantenimiento = $data->ultimomantenimiento;
        $vehiculo->seguro = $data->seguro;
        $vehiculo->idusuario = $data->idusuario;
        $vehiculo->fecha = $data->fecha;
        $vehiculo->segurovence = $data->segurovence;

        // Insertar datos
        $success = $vehiculo->create();

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
                "msg"       => "Error al insertar datos del vehículo"
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
