<?php
session_start();
if (!isset($_SESSION['nombre']) || !isset($_SESSION["clave"])) {
    header("Location: index.php");
    exit();
}

//Conexion a la BDD
require_once 'ConexionBDD.php';

//Class de la incidencia
require_once 'Incidencia.php';

//Obj de la incidencia
$incidencia_obj = new Incidencia();
$incidencia = null;

//Si el id existe, se obtiene la incidencia
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $incidencia = $incidencia_obj->obtenerPorId($id);
}

//Si la incidencia no existe mostrar error y regresar al listado
if (!$incidencia) {
    echo "Incidencia no encontrada.";
    echo '<br><a href="listar.php">Volver al listado</a>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Incidencia</title>
</head>
<body>
    <h1>Detalle de la Incidencia</h1>
    <p>Usuario: <?php echo htmlspecialchars($_SESSION["nombre"]); ?> </p> 
    <br>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($incidencia->getId()); ?></p>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($incidencia->getNombre()); ?></p>
    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($incidencia->getDescripcion()); ?></p>
    <p><strong>Prioridad:</strong> <?php echo htmlspecialchars($incidencia->getPrioridad()); ?></p>
    <br>
    <a href="listar.php">Regresar al listado</a>
    <br>
    <a href="cerrarsesion.php">Cerrar Sesión</a>
</body>
</html>