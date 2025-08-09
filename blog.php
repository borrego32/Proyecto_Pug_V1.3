<?php
session_start();

// Evitar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verificar si hay sesión activa
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Chat !Carly</title>
  <style>
    /* Estilos generales */
    body {
      margin: 0;
      font-family: 'Comic Sans MS', cursive;
      background-color: #3f464b;
      color: white;
    }

    /* ENCABEZADO */
    .header {
      background-color: #3a91b4;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      padding: 10px 30px;
    }

    /* Tamaño del logo */
    .logo img {
      height: 65px;
    }

    /* Estilos de enlaces de navegación */
    .nav_1 > a {
      text-decoration: none;
      color: black;
      font-size: 20px;
      font-weight: bold;
      margin-right: 20px;
    }

    /* Contenedor del menú de navegación */
    .nav_1 {
      display: flex;
      justify-content: flex-start;
      gap: 20px;
      margin-left: 275px; /* Empuja el menú a la derecha */
    }

    /* CONTENEDOR DEL CHAT */
    .chat-container {
      background-color: #2a2d30;
      width: 80%;
      max-width: 900px;
      margin: 40px auto;
      border-radius: 30px;
      padding: 20px;
    }

    /* Título del chat */
    .chat-header {
      font-size: 22px;
      font-weight: bold;
      color: #42a7c1;
      margin-bottom: 20px;
      text-align: center;
    }

    /* Área de mensajes del chat */
    #chat {
      background-color: #3f464b;
      border-radius: 20px;
      height: 300px;
      overflow-y: auto; /* Scroll vertical automático */
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

    /* Grupo de entrada (inputs + botones) */
    .input-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    /* Inputs de nombre y mensaje */
    #usuario, #mensaje {
      border: none;
      padding: 10px;
      border-radius: 20px;
      background: linear-gradient(to right, violet, cyan); /* Gradiente de color */
      color: black;
      font-size: 16px;
    }

    /* Input del nombre más pequeño */
    #usuario {
      width: 25%;
    }

    /* Input del mensaje ocupa el resto del espacio */
    #mensaje {
      flex: 1;
    }

    /* Botones de enviar y limpiar */
    .boton-chat {
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(to right, violet, cyan);
      font-weight: bold;
      cursor: pointer;
    }

    /* Efecto hover en botones */
    .boton-chat:hover {
      opacity: 0.9;
    }

        .usuario-logeado {
        position: fixed;
        top: 10px;
        right: 10px;
        background: #333;
        color: #fff;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 14px;
    }
  </style>
</head>
<body>

  <!-- ENCABEZADO CON LOGO Y MENÚ DE NAVEGACIÓN -->
  <div class="header">
    <div class="logo">
      <!-- Logo de iCarly -->
      <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/91a3378f-11bb-45c5-9fb4-bdaf842fafe2/d58xy2b-d2b2e6ec-5d62-4fd2-90cd-cb2bd506c709.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzkxYTMzNzhmLTExYmItNDVjNS05ZmI0LWJkYWY4NDJmYWZlMlwvZDU4eHkyYi1kMmIyZTZlYy01ZDYyLTRmZDItOTBjZC1jYjJiZDUwNmM3MDkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Anf4N8Ya-SlPG8i4npqtNka3qkG-8MNwFShwaPZgH4w" alt="iCarly Logo">
    </div>

    <div class="nav_1">
      <!-- Enlaces del menú -->
      <a href="inicio.php">INICIO</a>
      <a href="blog.php">BLOG</a>
      <a href="tienda.php">TIENDA</a>
      <a href="ayuda.php">AYUDA</a>
      <a href="https://www.nickelodeon.la/">Nickelodeon</a>
      <a href="cerrar.php">CERRAR SESIÓN</a>
      
    </div>
  </div>

  <!-- CONTENEDOR DEL CHAT -->
  <div class="chat-container">
    <div class="chat-header">CHAT EN VIVO</div>

    <!-- Área donde se muestran los mensajes -->
    <div id="chat"></div>

    <div class="usuario-logeado">
    Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
</div>

    <!-- Inputs y botones del chat -->
    <div class="input-group">
      <input type="text" id="usuario" placeholder="Tu nombre">
      <input type="text" id="mensaje" placeholder="Escribe algo...">
      <button id="enviar" class="boton-chat">Enviar</button>
      <button id="limpiar" class="boton-chat">Limpiar Chat</button>
    </div>
  </div>

  <!-- SCRIPTS DEL CHAT -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Función para cargar los mensajes del servidor cada 2 segundos
    function cargarMensajes() {
      $.get('recibir.php', function(data) {
        const mensajes = JSON.parse(data); // Convierte el JSON en arreglo
        const chatDiv = $('#chat');
        chatDiv.html(''); // Limpia el chat
        mensajes.forEach(m => {
          // Agrega cada mensaje al chat
          chatDiv.append(`<div class="chat-message"><strong>${m.usuario}:</strong> ${m.mensaje}</div>`);
        });
        // Desplaza hacia abajo automáticamente
        chatDiv.scrollTop(chatDiv[0].scrollHeight);
      });
    }

    // Función para enviar un nuevo mensaje
    function enviarMensaje() {
      const usuario = $('#usuario').val();
      const mensaje = $('#mensaje').val();

      // No permite campos vacíos
      if (usuario.trim() === '' || mensaje.trim() === '') return;

      // Envía el mensaje al servidor
      $.post('enviar.php', { usuario, mensaje }, function() {
        $('#mensaje').val(''); // Limpia el campo mensaje
        cargarMensajes(); // Recarga los mensajes
      });
    }

    // Evento al hacer clic en el botón "Enviar"
    $('#enviar').click(function() {
      enviarMensaje();
    });

    // Evento al presionar "Enter" dentro del campo mensaje
    $('#mensaje').keypress(function(e) {
      if (e.which === 13) {
        enviarMensaje();
      }
    });

    // Evento para limpiar el chat
    $('#limpiar').click(function() {
      $.post('limpiar.php', function(res) {
        if (res === 'ok') {
          $('#chat').html('');
        }
      });
    });

    // Carga mensajes cada 2 segundos
    setInterval(cargarMensajes, 2000);
    cargarMensajes(); // Llama una vez al iniciar
  </script>

</body>
</html>
