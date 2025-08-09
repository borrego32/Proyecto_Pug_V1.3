<?php
session_start();
require 'db.php'; // conexión mysqli como $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $clave = $_POST['clave'];


    $hash = password_hash($clave, PASSWORD_DEFAULT);


    if ($usuario === '' || $clave === '') {
        $error = "Completa todos los campos.";
    } else {
        // Buscar usuario admin por nombre
        $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        // Usar get_result() para obtener todos los datos del usuario
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $admin = $resultado->fetch_assoc(); // Array asociativo con todas las columnas

            // Acceder directamente a la columna que contiene el hash
            // Asegúrate de que en tu base de datos se llame realmente "clave"
            $hash_guardado = $admin['passw'];

            // Verificamos la contraseña (clave guardada debe estar hasheada)
            if (password_verify($clave, $hash)) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_nombre'] = $admin['usuario'];
                header('Location: admin_panel.php');
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado o no es administrador.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Administrador</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #282c34;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #eee;
  }
  form {
    background: #3a3f47;
    padding: 30px;
    border-radius: 10px;
    width: 320px;
    box-shadow: 0 0 10px rgba(0,0,0,0.6);
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: none;
    border-radius: 5px;
    font-size: 16px;
  }
  input[type="text"]:focus,
  input[type="password"]:focus {
    outline: 2px solid #61dafb;
  }
  button {
    width: 100%;
    padding: 12px;
    background: #61dafb;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 16px;
    color: #282c34;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  button:hover {
    background: #21a1f1;
  }
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  .error {
    background: #ff4c4c;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    text-align: center;
  }
  .legend {
    text-align: center;
    margin-top: 15px;
  }
  .legend a {
    color: #61dafb;
    text-decoration: none;
    font-weight: bold;
  }
  .legend a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

  <form method="POST" autocomplete="off">
    <h2>Administrador Login</h2>

    <?php if (isset($error)) : ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <input type="text" name="usuario" placeholder="Usuario admin" required autofocus />
    <input type="password" name="clave" placeholder="Contraseña" required />
    <button type="submit">Iniciar sesión</button>

    <div class="legend">
      <a href="login.php">Login usuario</a>
    </div>
  </form>

</body>
</html>

