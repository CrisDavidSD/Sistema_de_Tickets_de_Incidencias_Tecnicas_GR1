<?php
    #500.php - Internal Server Error
    session_start();
    session_destroy();
    http_response_code(500);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Error 500 - Internal Server Error</h1>
    <hr>
    <p>Ha ocurrido un error interno en el servidor.</p>
    <p>Regresar a la <a href="index.php">página principal</a></p>
</body>
</html>