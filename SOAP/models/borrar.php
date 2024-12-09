<?php

include_once "conexion.php";

class crudB{
    
    public static function borrarEstudiante(){

        $objeto = new Conexion();
        $cedula = $_GET['cedula'];
        $borrarEstudiantes = "DELETE FROM estudiantes WHERE cedula = '$cedula'";
        $conn = $objeto -> conectar();    
        $result = $conn -> prepare($borrarEstudiantes);
        $result -> execute();
        //print_r($data);
        $dataJson = json_encode("Se borro estudiante correctamente");
        print_r($dataJson);

    } 
}

?>