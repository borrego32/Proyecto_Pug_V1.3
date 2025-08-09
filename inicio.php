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

  // Variables básicas en PHP que se usarán para mostrar información en la página

  $titulo = "iCarly"; // Título principal de la página

  // Descripción larga de la serie, usando HTML dentro del texto (etiquetas <strong>)
  $descripcion = 'La historia de <strong>"iCarly"</strong> comienza cuando Carly Shay, una chica de 13 años, y su mejor amiga Sam Puckett, graban un video de ellas mismas para un concurso de talentos escolar. El amigo de Carly, Freddie Benson, sube accidentalmente el video a internet, donde se vuelve viral. El público pide más, y así nace el programa web <strong>"iCarly"</strong>, donde Carly, Sam y Freddie crean contenido divertido y realizan entrevistas a personas con talentos extraños. La serie sigue la vida de estos tres amigos mientras navegan por la escuela secundaria, las relaciones y la fama en línea, con Carly viviendo con su excéntrico hermano mayor Spencer y lidiando con la ausencia de su padre, un oficial de la Fuerza Aérea.';

  // URL de la imagen del logo de la serie
  $imagenLogo = "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/91a3378f-11bb-45c5-9fb4-bdaf842fafe2/d58xy2b-d2b2e6ec-5d62-4fd2-90cd-cb2bd506c709.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzkxYTMzNzhmLTExYmItNDVjNS05ZmI0LWJkYWY4NDJmYWZlMlwvZDU4eHkyYi1kMmIyZTZlYy01ZDYyLTRmZDItOTBjZC1jYjJiZDUwNmM3MDkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Anf4N8Ya-SlPG8i4npqtNka3qkG-8MNwFShwaPZgH4w";

  // URL de la imagen que aparecerá en la pantalla de la TV
  $imagenTV = "https://www.infobae.com/resizer/v2/LWTOV4ZHVZHUXIEYCSOMJZCO6E.jpg?auth=9ca4f69323a7c6a8c3c85fca5b6dbb8a8aac8d8a4d1fdb4c787f90c2f124e45f&smart=true&width=992&height=558&quality=85";
?>
<!DOCTYPE html> <!-- Declaración del tipo de documento HTML5 -->
<html lang="es"> <!-- El idioma principal del contenido es español -->
<head>
  <meta charset="UTF-8"> <!-- Codificación UTF-8 para caracteres especiales -->
  <title><?php echo $titulo; ?></title> <!-- Muestra el título desde la variable PHP -->

  <style>
    /* Estilo del cuerpo de la página */
    body {
      margin: 0; /* Elimina márgenes por defecto */
      background-color: #3b4043; /* Color de fondo gris oscuro */
    }

    /* Fuente general de toda la página */
    * {
      font-family: 'Comic Sans MS', cursive; /* Fuente estilo divertida */
    }

    /* Estilos del encabezado */
    header {
      background-color: #3a91b4; /* Fondo azul */
      display: flex; /* Coloca los elementos en línea */
      align-items: center; /* Centra verticalmente */
      justify-content: space-between; /* Espacia los elementos */
      padding: 10px 30px; /* Espaciado interno */
    }

    /* Tamaño del logo */
    #logo {
      height: 65px;
    }

    /* Estilo de los enlaces de navegación */
    nav a {
      color: black; /* Color de texto negro */
      font-weight: bold; /* Texto en negrita */
      margin: 0 15px; /* Espaciado lateral */
      text-decoration: none; /* Quita subrayado */
      font-size: 20px; /* Tamaño del texto */
    }

    /* Contenedor de íconos de navegación (si se usa) */
    .icons {
      display: flex;
      gap: 15px; /* Espacio entre íconos */
    }

    .icons a {
      text-decoration: none;
      color: black;
      font-size: 17px;
      font-weight: bold;
    }

    /* Contenedor principal del contenido */
    .main-content {
      display: flex; /* Distribuye en dos columnas */
      padding: 30px;
      gap: 40px; /* Espacio entre columnas */
    }

    /* Contenedor de la TV */
    .tv-container {
      text-align: center;
    }

    /* Caja que simula la TV */
    .tv {
      width: 360px;
      height: 200px;
      border: 5px solid black;
      background-color: black;
      position: relative; /* Permite posicionar elementos internos */
    }

    /* Imagen que aparece en la pantalla de la TV */
    .tv img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ajusta la imagen sin deformarla */
    }

    /* Imagen del mueble bajo la TV */
    .mueble {
      width: 360px;
      height: 120px;
      margin: 0 auto;
    }

    /* Caja lateral con la descripción */
    .contenido-lateral {
      flex-grow: 1;
      background-color: #2b2e31;
      border-radius: 30px; /* Bordes redondeados */
      padding: 30px;
      color: white;
      font-size: 18px;
      line-height: 1.6; /* Espaciado entre líneas */
    }

    /* Imagen del mueble decorativo */
    .tv .muev {
      position: absolute;
      top: 77%;
      left: -18%;
      width: 500px;
      height: 200px;
    }

    /* Ajustes del título y menú */
    .titulo {
      margin-top: 0px;
      margin-right: 375px;
    }

    /* Fondo para la sección de videos */
    .fondo-videos {
      background-color: #2b2e31;
      border-radius: 30px;
      padding: 40px;
      margin: 60px;
      overflow: hidden;
      position: relative;
      z-index: 0;
    }

    /* Contenedor de videos con animación */
    .video {
      display: flex;
      gap: 40px;
      animation: mover 15s linear infinite; /* Movimiento horizontal infinito */
      width: fit-content;
    }

    /* Animación de desplazamiento de videos */
    @keyframes mover {
      from {
        transform: translateX(0%);
      }
      to {
        transform: translateX(-50%);
      }
    }

    /* Contenedor que oculta el exceso de videos */
    .video-container {
      width: 100%;
      overflow: hidden;
      margin: 85px 0;
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

  <!-- ENCABEZADO CON LOGO Y MENÚ -->
  <header>
    <img id="logo" src="<?php echo $imagenLogo; ?>" alt="iCarly logo"> <!-- Logo de la serie -->
    <img id="mesa" src=""> <!-- Imagen vacía, posiblemente decorativa -->

    <div class="titulo">
      <nav>
        <!-- Enlaces de navegación -->
        <a href="blog.php">BLOG</a>
        <a href="tienda.php">TIENDA</a>
        <a href="ayuda.php">AYUDA</a>
        <a href="https://www.nickelodeon.la/">Nickelodeon</a>
        <a href="cerrar.php">CERRAR SESIÓN</a>
      </nav>
    </div>
  </header>

  <!-- CONTENIDO PRINCIPAL -->
  <div class="main-content">
    <!-- Contenedor con la TV -->
    <div class="tv-container">
      <div class="tv">
        <img src="<?php echo $imagenTV; ?>" alt="iCarly show"> <!-- Imagen dentro de la TV -->
        <img class="muev" src="/imagenes/mueble.png"> <!-- Imagen decorativa -->
      </div>
      <div class="mueble"></div> <!-- Base de la TV -->
    </div>

    <!-- Texto descriptivo a la derecha -->
    <div class="contenido-lateral">
      <p><?php echo $descripcion; ?></p> <!-- Descripción de la serie -->
    </div>
  </div>

  <div class="usuario-logeado">
    Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
</div>


  <!-- SECCIÓN DE VIDEOS -->
  <div class="fondo-videos">
    <div class="video-container">
      <div class="video">

        <!-- Lista de videos incrustados de YouTube -->
        <iframe width="350" height="200" src="https://www.youtube.com/embed/6mGe0UpAovk?si=Yg49IgVfIdOK08ok" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/1AC1W8H7RjY?si=Xm67VbUUs5XS2TH8" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/bsxjhwUdzEo?si=nN7GQPgX6Dsj3-cu" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/7ayBtBKR6uY?si=h7ZSV8YBk9JtAVbm" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/6mGe0UpAovk?si=Yg49IgVfIdOK08ok" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/1AC1W8H7RjY?si=Xm67VbUUs5XS2TH8" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/bsxjhwUdzEo?si=nN7GQPgX6Dsj3-cu" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

        <iframe width="350" height="200" src="https://www.youtube.com/embed/7ayBtBKR6uY?si=h7ZSV8YBk9JtAVbm" title="YouTube video player" frameborder="0" allowfullscreen></iframe>

      </div>
    </div>
  </div>
</body>
</html>
