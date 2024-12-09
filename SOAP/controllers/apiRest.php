<?php

// Incluimos los modelos necesarios
include '../models/acceder.php';
include '../models/guardar.php';
include '../models/borrar.php';
include '../models/editar.php';
include '../models/editar2.php';

$opc = $_SERVER['REQUEST_METHOD']; 

switch($opc) {
    case 'GET':
        if (isset($_GET['cedula'])) {
            $cedula = $_GET['cedula'];
            crudS::seleccionarEstudiante($cedula); 
        } else {
            crudS::seleccionarEstudiante(); 
        }
        break;

    case 'POST':
        crudI::guardarEstudiante(); 
        break;

    case 'DELETE':
        crudB::borrarEstudiante(); 
        break;

    case 'PUT':
        /* crudA::actualizarEstudiante($_GET['cedulaEditar'], $_GET['cedula'], $_GET['nombre'], $_GET['apellido'], $_GET['direccion'], $_GET['telefono']); */
        crudE::editarEstudiantes();
        break;
}

?>
