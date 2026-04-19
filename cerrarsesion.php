<?php
#Destruir la sesion del usuario y redireccionar a la pagina de inicio
session_start();
session_destroy();
header("Location: index.php");
exit();
?>