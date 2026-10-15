<?php
session_start(); //inicializa o renauda la sesion del usuario

$_SESSION["datos"] = []; //inicializa o renauda la sesion del usuario para almacenar datos

//arreglo asociativo sirve como base de datos local
// clave => valor, la clave viaja en el formulario, el valor es lo que se muestra en pantalla
$VIDEO_JUEGOS = [
    "MARIO" => ["nombre" => "MARIO BROS", "categoria" => "Plataforma", "costo" => 1.00],
    "MORTAL" =>["nombre" => "MORTAL KOMBAT", "categoria" => "Pelea", "costo" => 1.00],
    "ZELDA" => ["nombre" => "THE LEGEND OF ZELDA", "categoria" => "Aventura", "costo" => 2.00],
];

$error = []; //inicializa un arreglo vacio para guardar los mensajes de fallo
$categoria = ""; //almacena la clasificacion del participante
$descuento = 0; //tasa de descuento

//validaciones
if ($_SERVER["REQUEST_METHOD"] == "POST"){ //comprueba si la pagina se cargo al enviar el formulario por el method post
    if (!isset($_POST["nombre"]) and empty($_POST["nombre"])){ //evalua si la variable nombre no
        $error[]= "Error el campo nombre no existe o esta vacio";
    }
    if (!(isset($_POST["edad"])) or empty($_POST["edad"])){
        $error[]= "Error el campo edad no existe o esta vacio o no es un formato valido";
    }
    if (!(isset($_POST["correo"])) or empty($_POST["correo"])){
        $error[]= "Error el correo no existe o esta vacio o no es un formato valido";
    }
    if (!(isset($_POST["modalidad"])) or empty($_POST["modalidad"])){
        $error[]= "Error: modalidad no existe o esta vacio o no es un formato valido";
    }
    if(!(isset($_POST["experiencia"])) or empty($_POST["experiencia"])){
        $error[]= "Error: el campo experiencia no existe o esta vacio o no es un formato valido";
    }
    if (empty($error)){
        if ($_POST["edad"] > 15 and $_POST["experiencia"] == "Sin experiencia"){
            $categoria= "Aprendiendo";
        }
        elseif($_POST["edad"] > 15 and $_POST["edad"] <= 20 and $_POST["experiencia"] == "Novato"){
            $categoria= "Ya sabe";
        }

        $descuento = $_POST["experiencia"] == "Sin experiencia" ? 0.1 : 0;



        $_SESSION["datos"] [] = [
            "nombre" => $_POST["nombre"],
            "edad" => $_POST["edad"],
            "correo" => $_POST["correo"],
            "modalidad" => $_POST["modalidad"],
            "experiencia" => $_POST["experiencia"],
            "nombreJuego" => $VIDEO_JUEGOS[$_POST["videojuego"]]["nombre"],
            "costoJuego" => $VIDEO_JUEGOS[$_POST["videojuego"]]["costo"],
            "costoTotal" =>  calcularPrecio($VIDEO_JUEGOS[$_POST["videojuego"]]["costo"], $descuento)

        ];

        var_dump($_SESSION["datos"]);

    }
}

function calcularPrecio($valorInscripcion, $descuento){
    return $valorInscripcion - ($valorInscripcion * $descuento); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SOLUCION PARCIAL</h1>
    <div>
        <form action="" method="post">
            <label for="">Nombre</label>
            <input type="text" name="nombre">
            <label for="">Edad</label>
            <input type="text" name="edad">
            <label for="">Correo</label>
            <input type="text" name="correo">
            <label for="">Seleccione un juego</label>
            <select name="videojuego" id="">
                <?php foreach ($VIDEO_JUEGOS as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value["nombre"] ?></option>
                <?php endforeach; ?>
            </select>
            <label for="">Modalidad</label>
            <input type="radio" name="modalidad" value="Presencial"> <label>Presencial</label>
            <input type="radio" name="modalidad" value="Virtual"> <label>Virtual</label>

            <label for="">Nivel de experiencia</label>
            <input type="radio" name="experiencia" value="Sin experiencia"> <label>Sin experiencia</label>
            <input type="radio" name="experiencia" value="Novato"> <label>Novato</label>
            <input type="submit">  Enviar

        </form>
        <?php if (!empty($error)): ?>
            <?php foreach ($error as $value): ?>
                <p style="color: brown;"><?= $value ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    
</body>
</html>