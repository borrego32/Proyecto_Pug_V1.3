<?php
// Incluye el archivo de conexión a la base de datos (db.php) 
// para poder usar la variable $conn y conectarnos a la BD.
require 'db.php';

// Obtiene el valor enviado desde un formulario HTML (método POST) 
// para el campo 'usuario' y lo guarda en la variable $usuario.
$usuario = $_POST['usuario'];

// Obtiene el valor enviado desde el formulario para el campo 'mensaje' 
// y lo guarda en la variable $mensaje.
$mensaje = $_POST['mensaje'];

// Verifica que la variable $mensaje no esté vacía antes de guardarla en la base de datos.
if (!empty($mensaje)) {
    
    // Prepara una consulta SQL con parámetros para insertar los datos
    // en la tabla 'mensajes' en las columnas 'usuario' y 'mensaje'.
    $stmt = $conn->prepare("INSERT INTO mensajes (usuario, mensaje) VALUES (?, ?)");
    
    // Vincula las variables $usuario y $mensaje a los parámetros de la consulta.
    // "ss" indica que ambos parámetros son cadenas (string).
    $stmt->bind_param("ss", $usuario, $mensaje);
    
    // Ejecuta la consulta preparada, insertando los datos en la base de datos.
    $stmt->execute();
}
?>
