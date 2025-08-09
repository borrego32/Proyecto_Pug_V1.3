
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
  <title>iCarly - Ayuda</title>
  <style>
    /* Estilo general del cuerpo */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #3f464b; /* Fondo oscuro */
      color: white;
    }

    /* Fuente global estilo cómico */
    * {
      font-family: 'Comic Sans MS', cursive;
    }

    /* Encabezado superior (barra de navegación) */
    .header {
      background-color: #3a91b4; /* Color azul */
      display: flex; /* Flexbox para alinear contenido horizontalmente */
      align-items: center;
      padding: 10px 30px;
    }

    /* Tamaño del logo */
    .logo {
      height: 65px;
    }

    /* Menú de navegación */
    .nav {
      margin-left: auto; /* Empuja el menú hacia la derecha */
      display: flex;
      gap: 40px; /* Espacio entre enlaces */
      font-weight: bold;
      font-size: 20px;
      margin-right: 350px; /* Mueve todo el menú hacia la izquierda */
    }

    /* Estilo para los enlaces del menú */
    .nav a {
      color: black;
      text-decoration: none; /* Quita el subrayado */
    }

    /* Contenedor principal del mensaje de ayuda */
    .container {
      background-color: #2c2f31; /* Fondo gris oscuro */
      margin: 50px auto; /* Centrado vertical y horizontal */
      padding: 30px;
      max-width: 600px;
      border-radius: 20px; /* Bordes redondeados */
      text-align: center;
    }

    /* Contenedor de cada red social */
    .social {
      display: flex;
      justify-content: center; /* Centra horizontalmente */
      align-items: center;
      gap: 20px; /* Espacio entre ícono y enlace */
      margin: 20px 0;
    }

    /* Tamaño de los íconos de redes */
    .social img {
      width: 60px;
      height: 60px;
    }

    /* Estilo de los enlaces a redes sociales */
    .social a {
      color: white;
      font-size: 20px;
      text-decoration: none;
      background-color: #4c4f52;
      padding: 10px 20px;
      border-radius: 10px;
      transition: background-color 0.3s ease; /* Transición suave al hacer hover */
    }

    /* Cambio de color al pasar el cursor sobre el enlace */
    .social a:hover {
      background-color: #5e6366;
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

  <!-- Encabezado que incluye el logo y el menú -->
  <div class="header">
    <!-- Logo de iCarly -->
    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/91a3378f-11bb-45c5-9fb4-bdaf842fafe2/d58xy2b-d2b2e6ec-5d62-4fd2-90cd-cb2bd506c709.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzkxYTMzNzhmLTExYmItNDVjNS05ZmI0LWJkYWY4NDJmYWZlMlwvZDU4eHkyYi1kMmIyZTZlYy01ZDYyLTRmZDItOTBjZC1jYjJiZDUwNmM3MDkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Anf4N8Ya-SlPG8i4npqtNka3qkG-8MNwFShwaPZgH4w" 
         alt="iCarly Logo" 
         class="logo">

    <!-- Menú de navegación con enlaces a otras páginas -->
    <div class="nav">
      <a href="inicio.php">INICIO</a>
      <a href="blog.php">BLOG</a>
      <a href="tienda.php">TIENDA</a>
      <a href="ayuda.php">AYUDA</a>
      <a href="https://www.nickelodeon.la/">Nickelodeon</a>
      <a href="cerrar.php">CERRAR SESION</a>
      
    </div>
  </div>

  <!-- Contenedor principal con el mensaje de contacto -->
  <div class="container">
    <h2>si tienes dudas o problemas comunícate a través de nuestras redes</h2>

    <!-- Sección para Facebook -->
    <div class="social">
      <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
      <a href="https://www.facebook.com/share/16jrijdqaf/" target="_blank">!carly.fans</a>
    </div>

    <!-- Sección para WhatsApp -->
    <div class="social">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
      <a href="https://wa.me/528122542499" target="_blank">!carly.fans</a>
    </div>

    <!-- Sección para Instagram -->
    <div class="social">
      <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram">
      <a href="https://www.instagram.com/borrego170805/profilecard/?igsh=bmlmemR3dmtkcTN4" target="_blank">!carly.fans</a>
    </div>
  </div>
  <div class="usuario-logeado">
    Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
</div>

</body>
</html>
