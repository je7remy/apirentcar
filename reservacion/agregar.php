<?php
    include_once '../config/core.php';
    include_once 'reservacion.php'; // Se incluye el archivo de la clase Reservacion
    
    // Obtener conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();
    use \Firebase\JWT\JWT;
    
    // Instanciar objeto reservacion (en lugar de sucursal)
    $reservacion = new Reservacion($db); // Se instancia la clase Reservacion
    
    // Obtener datos enviados
    $data = json_decode(file_get_contents("php://input"));
    
    // Obtener JWT
    $jwt = isset($data->jwt) ? $data->jwt : "";
    
    // Si el JWT no está vacío
    if ($jwt) {
        // Si el JWT es válido, mostrar detalles de la reservacion
        try {
            // Establecer los valores de las propiedades de datos
            $reservacion->descripcion = $data->descripcion;
            $reservacion->estado = $data->estado;
            $reservacion->fechainicio = $data->fechainicio;
            $reservacion->fechafin = $data->fechafin;
            $reservacion->idcliente = $data->idcliente;
            $reservacion->idvehiculo = $data->idvehiculo;
            $reservacion->monto = $data->monto;
            $reservacion->descuento = $data->descuento;
            $reservacion->idusuario = $data->idusuario;
            $reservacion->fecharegistro = $data->fecharegistro;
    
            // Insertar datos
            $success = $reservacion->create(); // Se llama al método create() de la clase Reservacion
    
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
                    "msg"       => "Error al insertar datos de la reservacion"
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
