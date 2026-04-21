<?php
    #400.php - Página de confirmación de creación de incidencia
    session_start();

    #Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['nombre'])) {
        header("Location: index.php");
        exit();
    }

    http_response_code(400);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Error 400 - Bad Request</h1>
    <hr>
    <p>La incidencia no pudo ser creada debido a un error en la solicitud.</p>
    <p>Puede volver a <a href="registrar.php">registrar una nueva incidencia</a> o revisar la <a href="listar.php">Lista de incidencias</a> existentes</p>

</body>
</html>