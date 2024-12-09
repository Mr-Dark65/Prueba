<?php

include_once "conexion.php";
class crudI
{
    public static function guardarEstudiante()
    {
        $objetoConexion = new Conexion;
        $conn = $objetoConexion->conectar();

        // Verificar si los datos están disponibles en el arreglo $_POST
        if (isset($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'])) {
            // Asignar los valores de $_POST a las variables
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            // Insertar los datos en la base de datos
            $guardarEstudiante = "INSERT INTO estudiantes VALUES(:cedula, :nombre, :apellido, :direccion, :telefono)";
            $result = $conn->prepare($guardarEstudiante);
            $result->bindParam(':cedula', $cedula);
            $result->bindParam(':nombre', $nombre);
            $result->bindParam(':apellido', $apellido);
            $result->bindParam(':direccion', $direccion);
            $result->bindParam(':telefono', $telefono);

            if ($result->execute()) {
                // Enviar respuesta en JSON
                $response = ["message" => "Se insertó correctamente"];
            } else {
                // En caso de error
                $response = ["message" => "Error al insertar el estudiante"];
            }
        } else {
            // En caso de datos faltantes
            $response = ["message" => "Datos incompletos"];
        }

        // Imprimir respuesta en JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
?>
