<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>iCarly - Pago</title>
  <style>
    /* Estilos generales del cuerpo */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #3f464b;
      color: white;
    }

    /* Estilo del encabezado superior */
    .header {
      background-color: #3a91b4;
      display: flex;
      align-items: center;
      padding: 10px 30px;
    }
*{
         font-family: 'Comic Sans MS', cursive;
     }

    /* Logo de iCarly */
    .logo {
      height: 65px;
    }

    /* Navegación del encabezado */
    .nav {
      margin-left: auto;
      display: flex;
      gap: 40px;
      font-weight: bold;
      font-size: 20px;
      margin-top: 0px;
      
      margin-right: 400px;
    }

    /* Estilo de los enlaces del menú */
    .nav a {
      color: black;
      text-decoration: none;
    }

    /* Contenedor principal del formulario */
    .container {
      background-color: #2c2f31;
      margin: 50px auto;
      padding: 30px;
      max-width: 600px;
      border-radius: 30px;
    }

    /* Etiquetas de los campos */
    label {
      display: block;
      font-size: 18px;
      margin-bottom: 10px;
    }

    /* Campos de entrada y botón de envío */
    input[type="text"],
    input[type="number"],
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      color: white;
      background: linear-gradient(to right, #6f2eb7, #3ec6d3); /* Gradiente bonito */
    }

    /* Botón de enviar */
    input[type="submit"] {
      width: 150px;
      margin: 0 auto;
      display: block;
      cursor: pointer;
      transition: 0.3s ease;
    }

    /* Efecto al pasar el mouse sobre el botón */
    input[type="submit"]:hover {
      opacity: 0.9;
    }

    /* Color del texto en los placeholders */
    input::placeholder {
      color: #ddd;
    }

    /* Alineación del formulario */
    form {
      text-align: left;
    }

    /* Mensaje de compra exitosa (inicialmente oculto) */
    #mensaje {
      display: none;
      margin-top: 30px;
      text-align: center;
      font-size: 22px;
      color: white;
      background-color: #2c2f31;
      padding: 20px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <!-- Encabezado con logo y navegación -->
  <div class="header">
    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/91a3378f-11bb-45c5-9fb4-bdaf842fafe2/d58xy2b-d2b2e6ec-5d62-4fd2-90cd-cb2bd506c709.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzkxYTMzNzhmLTExYmItNDVjNS05ZmI0LWJkYWY4NDJmYWZlMlwvZDU4eHkyYi1kMmIyZTZlYy01ZDYyLTRmZDItOTBjZC1jYjJiZDUwNmM3MDkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Anf4N8Ya-SlPG8i4npqtNka3qkG-8MNwFShwaPZgH4w" alt="iCarly Logo" class="logo">
    <div class="nav">
    <a href="inicio.php">INICIO</a>
      <a href="blog.php">BLOG</a>
      <a href="tienda.php">TIENDA</a>
      <a href="ayuda.php">AYUDA</a>
      <a href="cerrar.php">CERRAR SESION</a>
    </div>
  </div>

  <!-- Contenedor del formulario -->
  <div class="container">
    <form id="formulario">
      <!-- Campo para nombre solo letras -->
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="escribe tu nombre"
             pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras, sin números" required>

      <!-- Campo para tarjeta solo números -->
      <label for="tarjeta">Número de tarjeta:</label>
      <input type="text" id="tarjeta" name="tarjeta" placeholder="escribe tu numero"
             pattern="[0-9]+" title="Solo números" required>

      <!-- Campo para fecha, acepta números y el número 7 -->
      <label for="fecha">Fecha de vencimiento:</label>
      <input type="text" id="fecha" name="fecha" placeholder="escribe tu fecha"
             pattern="[0-9 /]+" title="Solo números y el número /" required>

      <!-- Campo para CVV con 3 o 4 dígitos -->
      <label for="cvv">CVV:</label>
      <input type="text" id="cvv" name="cvv" placeholder="escribe tu numero"
             pattern="[0-9]{3,4}" title="Solo números (3 o 4 dígitos)" required>

      <!-- Botón para enviar el formulario -->
      <input type="submit" value="Comprar">
    </form>

    <!-- Mensaje que se muestra al completar compra -->
    <div id="mensaje">!Compra Exitosa</div>
  </div>

  <!-- Script para mostrar mensaje en pantalla sin recargar -->
  <script>
    const formulario = document.getElementById('formulario');
    const mensaje = document.getElementById('mensaje');

    formulario.addEventListener('submit', function(e) {
      e.preventDefault(); // Evita que se envíe el formulario a otra página
      if (formulario.checkValidity()) { // Verifica si el formulario es válido
        mensaje.style.display = 'block'; // Muestra el mensaje
        formulario.reset(); // Limpia los campos del formulario
      }
    });
  </script>

</body>
</html>
