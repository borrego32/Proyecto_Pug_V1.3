<?php
session_start();
require 'db.php'; // Asegúrate de que este archivo define $conn correctamente

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['usuario']);
    $contrasena = $_POST['clave'];

    if ($nombre === '' || $contrasena === '') {
        $error = "Completa todos los campos.";
    } else {
        // Validar que la contraseña cumpla con los requisitos de seguridad
        $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/";
        if (!preg_match($patron, $contrasena)) {
            $error = "La contraseña debe tener entre 8 y 12 caracteres, incluir mayúsculas, minúsculas, un número y un carácter especial.";
        } else {
            // Verificar si el usuario ya existe
            $consulta = $conn->prepare("SELECT id FROM usuarios WHERE nombre = ?");
            $consulta->bind_param("s", $nombre);
            $consulta->execute();
            $consulta->store_result();

            if ($consulta->num_rows > 0) {
                $error = "El usuario ya existe.";
            } else {
                // Encriptar contraseña y registrar nuevo usuario
                $encriptada = password_hash($contrasena, PASSWORD_DEFAULT);
                $consulta2 = $conn->prepare("INSERT INTO usuarios(nombre, password) VALUES (?, ?)");
                $consulta2->bind_param("ss", $nombre, $encriptada);

                if ($consulta2->execute()) {
                    $_SESSION['userid'] = $consulta2->insert_id; // <- GUARDAR ID del nuevo usuario
                    $_SESSION['nombre'] = $nombre;
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Error al registrar. Intenta más tarde.";
                }
                $consulta2->close();
            }

            $consulta->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #6c7075;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <form action="registro.php" method="POST">
        <h2>Crear Cuenta</h2>

        <?php if (!empty($error)) : ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <label for="usuario">Nombre de usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave"
               required
               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$"
               title="Debe tener entre 8 y 12 caracteres, con al menos una mayúscula, una minúscula, un número y un carácter especial">

        <input type="submit" value="Registrarse">
    </form>

</body>
</html>
