<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


//importar la base de datos
require'db.php';
//esta parte funciona para guardar la informacion del usuario para que no se pierda a la hora de salir y que al entrar esten sus datos
session_start();
//si el server tien el metodo POST crearemos dos variables(nombre que recogera los datos del input usuario, lo msmo para clave),trim es para vaciar la variable
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   


$nombre=trim($_POST['usuario']);
$contraseña= $_POST['clave'];

$consulta = $conn->prepare("SELECT id,password FROM usuarios WHERE nombre= ?");
//bind param es para asignar valores a una consulta de manera segura
$consulta->bind_param("s",$nombre);
$consulta->execute();
$consulta->store_result();
$consulta->bind_result($id,$hash);

if($consulta->num_rows==1){
    $consulta->fetch();
    if(password_verify($contraseña, $hash)){
        $_SESSION['userid']= $id ;
        $_SESSION['nombre']= $nombre;
        header("Location: inicio.php");
        exit();

    }else{
        $error = "Contraseña incorrecta";

    }
}else{
    $error = "usuario no encontrado";
}
$consulta->close();
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar Sesión</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #6c7075;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      
      background-image:url(fondo/fondo.jpeg);
      background-repeat:no-repeat;
      background-attachment:fixed;
      background-size:cover;
      
    }

    .login-container {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .form-group input {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-button {
      width: 100%;
      padding: 0.75rem;
      border: none;
      background-color: #007bff;
      color: white;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
    }

    .login-button:hover {
      background-color: #0056b3;
    }

    .register-link {
      margin-top: 1rem;
      text-align: center;
      font-size: 0.9rem;
    }

    .register-link a {
      color: #007bff;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required />
      </div>
      <div class="form-group">
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required />
      </div>
      <button type="submit" class="login-button">Entrar</button>
    </form>
    <div class="register-link">
      ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
    </div>
     <div class="register-link">
      ¿Eres administrador? <a href="login_admin.php">presiona aqui</a>
    </div>
  </div>

</body>
</html>
