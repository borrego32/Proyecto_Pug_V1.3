
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
  <meta charset="UTF-8"> <!-- Codificación de caracteres para soporte de acentos y caracteres especiales -->
  <title>iCarly Tienda</title> <!-- Título que aparece en la pestaña del navegador -->

  <style>
    /* Estilos generales para todo el cuerpo */
    body {
      margin: 0; /* Quita márgenes predeterminados */
      font-family: Arial, sans-serif; /* Fuente base para el contenido */
      background-color: #3c3c3c; /* Color de fondo gris oscuro */
      color: #fff; /* Color blanco para texto */
    }

    /* Sobrescribe la fuente para todos los elementos */
    * {
      font-family: 'Comic Sans MS', cursive;
    }

    /* Estilo del encabezado */
    header {
      background-color: #3a91b4; /* Fondo azul */
      display: flex; /* Usa flexbox para organizar elementos en línea */
      align-items: center; /* Alinea verticalmente los elementos */
      justify-content: space-between; /* Espacio entre elementos extremos */
      padding: 10px 40px; /* Espaciado interno horizontal y vertical */
    }

    /* Imagen dentro del header (logo) */
    header img {
      height: 65px; /* Altura fija para el logo */
    }

    /* Estilos para los enlaces del menú */
    nav a {
      margin: 0 20px; /* Margen horizontal entre enlaces */
      text-decoration: none; /* Quita subrayado */
      color: black; /* Color negro para enlaces */
      font-weight: bold; /* Texto en negrita */
      font-size: 20px; /* Tamaño de fuente */
    }

    /* Contenedor principal de productos con grid */
    .productos {
      display: grid; /* Layout en cuadrícula */
      grid-template-columns: repeat(3, 1fr); /* 3 columnas de igual tamaño */
      gap: 40px; /* Espacio entre productos */
      padding: 40px; /* Espaciado interno */
      max-width: 1000px; /* Ancho máximo del contenedor */
      margin: auto; /* Centrar horizontalmente */
    }

    /* Estilo individual de cada producto */
    .producto {
      background-color: #56a2c1; /* Fondo azul claro */
      padding: 20px; /* Espaciado interno */
      text-align: center; /* Centra contenido */
      border-radius: 10px; /* Bordes redondeados */
    }

    /* Imagen del producto */
    .producto img {
      width: 125px; /* Ancho fijo */
      height: auto; /* Altura automática para mantener proporción */
      margin-bottom: 10px; /* Espacio debajo de la imagen */
      margin-left: 40px; /* Margen izquierdo */
      margin-top: 30px; /* Margen arriba */
      margin-right: 35px; /* Margen derecho */
    }

    /* Precio del producto */
    .precio {
      font-weight: bold; /* Negrita */
      margin-bottom: 10px; /* Espacio debajo del precio */
    }

    /* Estilo del botón "Comprar" */
    .boton {
      background-color: #3c3c3c; /* Fondo oscuro */
      color: white; /* Texto blanco */
      padding: 10px 20px; /* Espaciado interno */
      border: none; /* Sin borde */
      border-radius: 20px; /* Bordes redondeados */
      cursor: pointer; /* Cursor de mano para indicar clickeable */
      margin-left: 40px; /* Margen izquierdo */
      margin-top: 15px; /* Margen superior */
      margin-right: 35px; /* Margen derecho */
      transition: all 0.3s ease; /* Transición suave para efectos */
      transform: scale(1); /* Tamaño inicial */
      text-decoration: none; /* Sin subrayado */
      display: inline-block; /* Para que el padding funcione bien */
    }

    /* Efectos al pasar el cursor sobre el botón */
    .boton:hover {
      background-color: #2a2a2a; /* Fondo más oscuro */
      transform: scale(1.1); /* Agranda ligeramente */
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3); /* Sombra para efecto de profundidad */
    }

    /* Estilo para la clase titulo (probablemente para el menú) */
    .titulo {
      margin-top: 0px;
      margin-right: 300px;
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

  <!-- Encabezado con logo y navegación -->
  <header>
    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/91a3378f-11bb-45c5-9fb4-bdaf842fafe2/d58xy2b-d2b2e6ec-5d62-4fd2-90cd-cb2bd506c709.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzkxYTMzNzhmLTExYmItNDVjNS05ZmI0LWJkYWY4NDJmYWZlMlwvZDU4eHkyYi1kMmIyZTZlYy01ZDYyLTRmZDItOTBjZC1jYjJiZDUwNmM3MDkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Anf4N8Ya-SlPG8i4npqtNka3qkG-8MNwFShwaPZgH4w" alt="iCarly"> <!-- Logo iCarly -->

    <div class="titulo">
      <nav>
        <!-- Enlaces del menú de navegación -->
        <a href="inicio.php">INICIO</a>
        <a href="blog.php">BLOG</a>
        <a href="tienda.php">TIENDA</a>
        <a href="ayuda.php">AYUDA</a>
        <a href="https://www.nickelodeon.la/">Nickelodeon</a>
        <a href="cerrar.php">CERRAR SESION</a>
      </nav>
    </div>
  </header>

  <!-- Contenedor con los productos -->
  <div class="productos">

    <!-- Producto 1 -->
    <div class="producto">
      <div align="center" class="precio">129 MNX </div> <!-- Precio -->
      <img src="https://i.etsystatic.com/49345208/r/il/c3cac2/5815042758/il_680x540.5815042758_ba6w.jpg" alt="Camisa Maybe Okay"> <!-- Imagen -->
      <a href="pagos.php" class="boton">Comprar</a> <!-- Botón para comprar -->
    </div>

    <!-- Producto 2 -->
    <div class="producto">
      <div class="precio">159 MNX</div>
      <img src="https://m.media-amazon.com/images/I/51kFSEdX4iL._AC_SX679_.jpg" alt="Camisa iCarly Blanca">
      <a href="pagos.php" class="boton">Comprar</a>
    </div>

    <!-- Producto 3 -->
    <div class="producto">
      <div class="precio">179 MNX</div>
      <img src="https://m.media-amazon.com/images/I/B1pppR4gVKL._CLa%7C2140%2C2000%7C91ZQTpAr9nL.png%7C0%2C0%2C2140%2C2000%2B0.0%2C0.0%2C2140.0%2C2000.0_AC_SX679_.png" alt="Camisa Negra Gráfica">
      <a href="pagos.php" class="boton">Comprar</a>
    </div>

    <!-- Producto 4 -->
    <div class="producto">
      <div class="precio">159 MNX</div>
      <img src="https://m.media-amazon.com/images/I/51IkBT-7HXL._AC_SX679_.jpg" alt="Camisa Negra iCarly">
      <a href="pagos.php" class="boton">Comprar</a>
    </div>

    <!-- Producto 5 -->
    <div class="producto">
      <div class="precio">249 MNX</div>
      <img src="https://m.media-amazon.com/images/I/A18Zbr2L5LL._CLa%7C2140%2C2000%7CB1XygSJlbjL.png%7C0%2C0%2C2140%2C2000%2B0.0%2C0.0%2C2140.0%2C2000.0_AC_SX466_.png" alt="Sudadera Negra iCarly">
      <a href="pagos.php" class="boton">Comprar</a>
    </div>

    <!-- Producto 6 -->
    <div class="producto">
      <div class="precio">249 MNX</div>
      <img src="https://m.media-amazon.com/images/I/B1Ut5Nq8rrL._CLa%7C2140%2C2000%7CB1XygSJlbjL.png%7C0%2C0%2C2140%2C2000%2B0.0%2C0.0%2C2140.0%2C2000.0_AC_SX466_.png" alt="Sudadera Gris iCarly">
      <a href="pagos.php" class="boton">Comprar</a>
    </div>

  </div>
  <div class="usuario-logeado">
    Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
</div>

</body>
</html>
