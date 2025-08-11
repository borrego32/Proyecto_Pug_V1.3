<?php
// Inicia la sesión para acceder a las variables de sesión
session_start();

// Evitar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verifica si el administrador ha iniciado sesión.
// Si no está definido 'admin_id', redirige al login.
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit(); // Detiene la ejecución del script
}

// Incluye el archivo de conexión a la base de datos
require 'db.php';

// Ejecuta una consulta para obtener todos los usuarios de la base de datos
$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel del Administrador</title>
  <style>
    /* Estilos generales para el cuerpo de la página */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 20px;
      color: #333;
    }

    /* Estilos para el título principal */
    h2 {
      color: #2c3e50;
      text-align: center;
      margin-bottom: 10px;
    }

    /* Estilos para el mensaje de bienvenida */
    p {
      text-align: center;
      font-size: 18px;
      margin-bottom: 20px;
      color: #555;
    }

    /* Estilos para el botón de cerrar sesión */
    a.cerrar-sesion {
      display: block;
      width: max-content;
      margin: 0 auto 30px;
      padding: 10px 25px;
      background: #e74c3c;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    /* Estilo al pasar el mouse por el botón de cerrar sesión */
    a.cerrar-sesion:hover {
      background-color: #c0392b;
    }

    /* Estilos para la tabla que muestra los usuarios */
    table {
      width: 90%;
      max-width: 900px;
      margin: 0 auto;
      border-collapse: collapse;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      background: white;
      border-radius: 10px;
      overflow: hidden;
    }

    /* Estilos para las celdas de la tabla */
    th, td {
      padding: 12px 20px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    /* Estilos para la fila de encabezado */
    th {
      background-color: #2980b9;
      color: white;
      font-weight: 600;
    }

    /* Color de fondo al pasar el cursor sobre una fila */
    tr:hover {
      background-color: #f1f8ff;
    }

    /* Estilos para el enlace de eliminar */
    a.eliminar {
      color: #e74c3c;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    /* Estilo cuando el mouse pasa por el enlace de eliminar */
    a.eliminar:hover {
      color: #c0392b;
      text-decoration: underline;
    }
         .boton-chat {
      background-color: #4CAF50; /* verde */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-left: 675px;
      margin-top: 30px;
    }
    .boton-chat:hover{

         background-color: #45a049;
    }
        #chat {
        margin-top: 50px;
      background-color: #c3c3c3;
      border-radius: 20px;
      height: 200px;
      overflow-y: auto; 
      padding: 15px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
    }

    /* Cada mensaje del chat */
    .chat-message {
      margin-bottom: 10px;
      padding: 8px 12px;
      background-color: #50585e;
      border-radius: 10px;
      width: fit-content;
      max-width: 80%;
    }
/* Título del chat */
    .chat-header {
      font-size: 22px;
      font-weight: bold;
      color: #42a7c1;
      margin-bottom: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- Título del panel -->
<h2>Panel del Administrador</h2>

<!-- Muestra el nombre del administrador desde la sesión -->
<p>Bienvenido, <?= htmlspecialchars($_SESSION['admin_nombre']) ?></p>

<!-- Enlace para cerrar sesión -->
<a href="cerrar_admin.php" class="cerrar-sesion">CERRAR SESIÓN</a>

<!-- Tabla de usuarios -->
<table border="1">
  <tr>
    <th>ID</th><th>Usuario</th><th>Acción</th>
  </tr>

  <!-- Bucle que recorre cada fila (usuario) y muestra sus datos -->
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['id'] ?></td> <!-- Muestra el ID del usuario -->
    <td><?= htmlspecialchars($row['nombre']) ?></td> <!-- Muestra el nombre del usuario, protegido contra XSS -->
    <td>
      <!-- Enlace para eliminar al usuario con confirmación -->
      <a href="eliminar_usuario.php?id=<?= $row['id'] ?>" 
         onclick="return confirm('¿Seguro que quieres eliminar este perfil?')" 
         class="eliminar" 
         name="borrar">Eliminar</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
<div class="input-group">
   
      <button id="limpiar" class="boton-chat">Limpiar Chat</button>
    </div>

<div id="chat"></div>

<div class="chat-header">CHAT EN VIVO</div>
</body>
</html>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

 // Evento para limpiar el chat
    $('#limpiar').click(function() {
      $.post('limpiar.php', function(res) {
        if (res === 'ok') {
          $('#chat').html('');
        }
      });
    });
</script>
