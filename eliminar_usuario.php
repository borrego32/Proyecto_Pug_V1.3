<?php
// Inicia la sesión para poder acceder a las variables de sesión
session_start();

// Verifica si el administrador ha iniciado sesión.
// Si no está autenticado (no existe 'admin_id'), lo redirige al login.
if (!isset($_SESSION['admin_id'])) {
  header("Location: login_admin.php");
  exit; // Detiene la ejecución del script
}

// Incluye el archivo que establece la conexión con la base de datos
require 'db.php';

// Verifica si se ha enviado el parámetro 'id' por la URL (método GET)
if (isset($_GET['id'])) {
  // Convierte el valor recibido a un número entero para evitar inyecciones SQL
  $id = $_GET['id']; //este cambio te puede ayudar a manejar la base de datos de manera manual

  // Prepara una sentencia SQL para eliminar el usuario con el ID especificado
  $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");

  // Asocia el valor de $id como un entero ("i" = integer)
  $stmt->bind_param("i", $id);

  // Ejecuta la sentencia preparada
  $stmt->execute();
}

// Redirige nuevamente al panel de administración después de eliminar el usuario
header("Location: admin_panel.php");
exit; // Detiene el script por seguridad
?>
