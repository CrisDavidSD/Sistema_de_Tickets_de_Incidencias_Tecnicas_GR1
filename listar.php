<?php
session_start();
if( !isset($_SESSION['nombre']) && !isset($_SESSION["clave"])  ){
    header("Location: index.php");
}
require_once 'ConexionBDD.php';
require_once 'Incidencia.php';

// Obtener el ID del usuario logueado desde la sesión
$usuario_id = $_SESSION['usuario_id'];
// Obtener las incidencias del usuario
$incidencia = new Incidencia();
$incidencias = $incidencia->obtenerPorUsuarioId($usuario_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Incidencias Registradas</h1>
    <p>Usuario: <?php echo $_SESSION["nombre"]?></p>

    <h3>Lista de incidencias</h3>
    <ul>
        <?php foreach ($incidencias as $item): ?>
            <li><?php echo $item->getId(); ?> - <a href="detalle.php?id=<?php echo $item->getId(); ?>">
                <?php echo $item->getNombre(); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <a href="registrar.php">Registrar nueva incidencia</a>
    <br>
    <a href="cerrarsesion.php">Cerrar Sesión</a>
</body>
</html>