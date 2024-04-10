<?php
include_once '../config/core.php';
include_once 'cliente.php'; // Se incluye el archivo de la clase Cliente
use \Firebase\JWT\JWT;

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar objeto Cliente
$cliente = new Cliente($db); // Se instancia la clase Cliente

// Obtener datos enviados
$data = json_decode(file_get_contents("php://input"));

// Obtener JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

// Si el JWT no está vacío
if ($jwt) {
    // Si la decodificación es exitosa, insertar detalles del cliente
    try {
        // Establecer los valores de las propiedades de datos
        $cliente->nombre = $data->nombre;
        $cliente->apellido = $data->apellido;
        $cliente->sexo = $data->sexo;
        $cliente->whatsapp = $data->whatsapp;
        $cliente->correo = $data->correo;
        $cliente->telefonol = $data->telefonol;
        $cliente->telefono2 = $data->telefono2;
        $cliente->estado = $data->estado;
        $cliente->tipo_identificacion = $data->tipo_identificacion;
        $cliente->numero_identificacion = $data->numero_identificacion;
        $cliente->usuario_registro = $data->usuario_registro;
        $cliente->fecha_registro = $data->fecha_registro;
        $cliente->usuario_modificado = $data->usuario_modificado;
        $cliente->fecha_modificado = $data->fecha_modificado;

        // Insertar datos del cliente
        $success = $cliente->create(); // Se llama al método create() de la clase Cliente

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
                "msg"       => "Error al insertar detalles del cliente"
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
