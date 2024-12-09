<?php

include_once "conexion.php";

class crudS {

    public static function seleccionarEstudiante($cedula = null) {
        $objeto = new Conexion();
        $conn = $objeto->conectar();

        if ($cedula) {
            $selectEstudiantes = "SELECT * FROM estudiantes WHERE cedula = :cedula";
            $result = $conn->prepare($selectEstudiantes);
            $result->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        } else {
            $selectEstudiantes = "SELECT * FROM estudiantes";
            $result = $conn->prepare($selectEstudiantes);
        }

        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $dataJson = json_encode($data);
        print_r($dataJson);
    }
}

?>
