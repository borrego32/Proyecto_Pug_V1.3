<?php
require 'db.php'; // Incluye el archivo de conexión a la base de datos para usar la variable $conn

// Ejecuta una consulta SQL que obtiene todos los campos (*) de la tabla 'mensajes',
// ordenados por la columna 'fecha' en orden descendente (más recientes primero),
// y limita el resultado a 20 registros.
$resultado = $conn->query("SELECT * FROM mensajes ORDER BY fecha DESC LIMIT 20");

// Crea un arreglo vacío para almacenar los mensajes que se obtengan de la consulta.
$mensajes = [];

// Recorre cada fila de resultados obtenidos de la consulta.
// fetch_assoc() devuelve la fila como un arreglo asociativo (clave = nombre de la columna).
while ($fila = $resultado->fetch_assoc()) {
    $mensajes[] = $fila; // Agrega cada fila al arreglo $mensajes.
}

// Convierte el arreglo de mensajes a formato JSON.
// array_reverse($mensajes) invierte el orden para que los mensajes más antiguos aparezcan primero.
echo json_encode(array_reverse($mensajes)); // los más antiguos primero
?>
