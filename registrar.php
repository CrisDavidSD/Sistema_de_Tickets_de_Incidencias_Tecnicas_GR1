<?php
session_start();

if(!isset($_SESSION['nombre']) && !isset($_SESSION['clave'])){
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre      = trim($_POST['nombre']      ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $prioridad   = trim($_POST['prioridad']   ?? '');

    // --- Validación ---
    $errores = [];

    if ($nombre === '') {
        $errores[] = 'El nombre es obligatorio.';
    }

    if ($descripcion === '') {
        $errores[] = 'La descripción es obligatoria.';
    }

    $prioridadesValidas = ['Baja', 'Media', 'Alta'];
    if (!in_array($prioridad, $prioridadesValidas)) {
        $errores[] = 'La prioridad seleccionada no es válida.';
    }

    // Si hay errores de validación → 400
    if (!empty($errores)) {
        header("Location: 400.php");
        exit();
    }

    // --- Inserción en BDD ---
    try {
        require_once 'Incidencia.php';
        require_once 'Usuario.php';

        // Obtener el id del usuario desde la sesión consultando la BDD
        $usuarioObj = new Usuario();
        $usuarioObj->validarCredenciales($_SESSION['nombre'], $_SESSION['clave']);
        $usuario_id = $usuarioObj->getId();

        $incidencia = new Incidencia($nombre, $descripcion, $prioridad, $usuario_id);
        $ok = $incidencia->insertar();

        if ($ok) {
            // Guardado exitoso → 201
            header("Location: 201.php");
            exit();
        } else {
            // Fallo inesperado sin excepción → 500
            header("Location: 500.php");
            exit();
        }

    } catch (Exception $e) {
        // Error de conexión o SQL → 500
        header("Location: 500.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Incidencias</title>
    </head>
    <body>
        <h1>Registrar nueva incidencia</h1>

        <form action="registrar.php" method="POST">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ejemplo: Error en módulo de pagos" required> <br><br>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Detalla la incidencia" required></textarea> <br><br>

            <label for="prioridad">Prioridad</label>
            <select id="prioridad" name="prioridad" required>
                <option value="">Selecciona un nivel de prioridad</option>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>
             <br><br>

            <input type="submit" value="Guardar incidencia">
        </form>

         <a href="listar.php">Volver al listado</a>
         <br>
         <a href="cerrarsesion.php">Cerrar Sesión</a>
    </body>
</html>