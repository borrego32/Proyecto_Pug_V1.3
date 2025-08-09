<?php
session_start(); // Inicia o reanuda la sesión actual para poder trabajar con sus variables

session_unset(); // Elimina todas las variables de sesión registradas

session_destroy(); // Destruye por completo la sesión actual en el servidor

header('Location: login_admin.php'); // Redirige al usuario a la página 'login_admin.php'

exit(); // Finaliza la ejecución del script para asegurar que no se ejecute más código después de la redirección
?>
