<?php
    #201.php - Página de confirmación de creación de incidencia
    session_start();

    #Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['nombre'])) {
        header("Location: index.php");
        exit();
    }

    http_response_code(201);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Incidencia Creada - 201 Created</h1>
    <hr>
    <p>La incidencia ha sido creada exitosamente.</p>
    <p>Puede volver a <a href="listar.php">la lista de incidencias</a> para crear otra incidencia o revisar las existentes.</p>

</body>
</html>