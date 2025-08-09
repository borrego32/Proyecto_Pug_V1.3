<?php
require 'db.php'; // Incluye el archivo de conexión a la base de datos para poder usar la variable $conn

$conn->query("DELETE FROM mensajes"); // Ejecuta una consulta SQL que elimina TODOS los registros de la tabla 'mensajes'

echo "ok"; // Muestra el texto "ok" como respuesta, indicando que la operación se realizó
?>
