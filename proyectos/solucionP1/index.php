<?php 

session_start();


$videojuegos = [
    'fifa' => [ 'nombre' => 'EA Sports FC 24',
    'categoria' => 'Deportes',
    'costo' => 12.00,
    'cupo_maximo' => 16],

    'smash' => [ 'nombre' => 'Super Smash Bros. Ultimate',
    'categoria' => 'Lucha',
    'costo' => 15.00,
    'cupo_maximo' => 32]

];

$errores =[];
$comprobanteActual = null;

$datos = [
    'nombre'        => '',
    'edad'          =>'',
    'correo'        =>'',
    'es_estudiante' =>'no',
    'juego'         =>'',
    'modalidad'     =>'',
    'experiencia'     =>''
];




?>