<?php
    include_once '../config/core.php';
    include_once 'sucursal.php';
    
    // Obtener conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();
    use \Firebase\JWT\JWT;
    
    // Instanciar objeto sucursal
    $sucursal = new Sucursal($db);
    
    // Obtener JWT enviado
    // Obtener datos enviados
    $data = json_decode(file_get_contents("php://input"));
    
    // Obtener JWT
    $jwt = isset($data->jwt) ? $data->jwt : "";
    
    // Decodificar JWT
    // Si el JWT no está vacío
    if ($jwt) {
        // Si la decodificación es exitosa, mostrar detalles de la sucursal
        try {
            // Establecer los valores de las propiedades de la sucursal
            $sucursal->idsucursal = $data->idsucursal;
            $sucursal->nombre = $data->nombre;
            $sucursal->estado = $data->estado;
            $sucursal->idempresa = $data->idempresa;
            $sucursal->idusuario = $data->idusuario;
    
            // Actualizar la sucursal
            $success = $sucursal->update();
    
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
                    "msg"       => "Error al actualizar datos de la sucursal"
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
