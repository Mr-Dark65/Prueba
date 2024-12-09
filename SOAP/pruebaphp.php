<?php

//objeto en php
$objeto = new stdClass();
$objeto -> nombre = "Steeven";
$objeto -> apellido = "Loor";
print_r($objeto -> nombre);
echo("<br>");
echo(gettype($objeto));
echo("<br>");
//array vector
$colores = array("azul","verde","rojo");
print_r($colores[0]);
echo("<br>");
echo(gettype($colores));
echo("<br>");
//array asociativo clave valor
$arrayaso = array("nombre"=>"Steeven","apellido"=>"Loor");
print_r($arrayaso['nombre']);

echo("<br>");
$mijson = JSON_ENCODE($arrayaso);
print_r($mijson);

echo("<br>");
//lista
$lista = '{"nombre":"Steeven","apellido":"Loor"}';
//print_r($lista);
echo("<br>");
$miphp = JSON_DECODE($lista);
print_r($miphp->nombre);
echo(gettype($miphp));
//JSON_ENCODE -> convierte el objeto en formato json

//JSON_DECOE -> JSON A TIPO DE DATO DE PHP




?>