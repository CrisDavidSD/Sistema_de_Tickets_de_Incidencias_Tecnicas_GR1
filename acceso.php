<?php
session_start();

require_once 'Usuario.php';

if($_POST['nombre']!="" && $_POST['clave']!=""){

    $miUsuario = new Usuario();
    $loginValido = $miUsuario->validarCredenciales($_POST['nombre'], $_POST['clave']);

    if($loginValido){
        // Si las credenciales son válidas, se establece la sesión
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['clave'] = $_POST['clave'];

        // Navegar hacia el panel principal
        header("Location: listar.php");
        exit();
    }else{
        header("Location: index.php");
        exit();
    }

}else{
    //Navegar hacia el index
    header("Location: index.php");
    exit();
}
?>