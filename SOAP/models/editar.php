<?php
include_once("conexion.php");
class crudA
{
    public static function actualizarEstudiante($cedulaActualizar, $cedula, $nombre, $apellido, $direccion, $telefono)
    {

        $actualizarEstudiante = "update estudiantes set cedula='$cedula', nombre='$nombre',apellido='$apellido',direccion='$direccion',telefono='$telefono' where cedula='$cedulaActualizar'";
        $conexion = new conexion();
        $conn = $conexion->conectar();
        $resultado = $conn->prepare($actualizarEstudiante);
        $resultado->execute();
        print_r(json_encode("Se actualizo Correctamente"));
    }
}