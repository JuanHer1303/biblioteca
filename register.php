<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $carrera = htmlspecialchars($_POST['carrera']);
    $matricula = htmlspecialchars($_POST['matricula']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    // Encriptar la contraseña
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insertar en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, carrera, matricula, email, password) VALUES (?, ?, ?, ?, ?)");
    
    try {
        if ($stmt->execute([$nombre, $carrera, $matricula, $email, $password])) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error al registrar el usuario.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Muestra el error específico
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form method="POST" action="">
        <input type="text" name="nombre" required placeholder="Nombre">
        <input type="text" name="carrera" required placeholder="Carrera">
        <input type="text" name="matricula" required placeholder="Matrícula">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Contraseña">
        <button type="submit">Registrar</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>