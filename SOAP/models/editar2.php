<?php
class crudE {
    public static function editarEstudiantes() {
        include_once "conexion.php";
        $objetoconexion = new conexion();
        $conn = $objetoconexion->conectar();

        // Validar que el método sea PUT
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Leer los datos enviados en el cuerpo de la solicitud
            parse_str(file_get_contents("php://input"), $_PUT);

            // Validar que todos los campos necesarios estén presentes
            if (isset($_PUT['cedula'], $_PUT['nombre'], $_PUT['apellido'], $_PUT['direccion'], $_PUT['telefono'])) {
                $cedula = $_PUT['cedula'];
                $nombre = $_PUT['nombre'];
                $apellido = $_PUT['apellido'];
                $direccion = $_PUT['direccion'];
                $telefono = $_PUT['telefono'];

                // Query para actualizar el estudiante
                $editarEstudiante = "UPDATE estudiantes 
                                     SET nombre = :nombre, apellido = :apellido, direccion = :direccion, telefono = :telefono 
                                     WHERE cedula = :cedula";

                $stmt = $conn->prepare($editarEstudiante);
                $stmt->bindParam(':cedula', $cedula);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido', $apellido);
                $stmt->bindParam(':direccion', $direccion);
                $stmt->bindParam(':telefono', $telefono);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    echo json_encode(["message" => "Estudiante actualizado correctamente."]);
                } else {
                    echo json_encode(["error" => "Error al actualizar el estudiante."]);
                }
            } else {
                echo json_encode(["error" => "Faltan datos obligatorios."]);
            }
        } else {
            echo json_encode(["error" => "Método no permitido."]);
        }
    }
}

?>