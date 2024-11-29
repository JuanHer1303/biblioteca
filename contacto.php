<?php
session_start(); // Iniciar sesión si no está activa
include 'db.php'; // Incluir conexión a la base de datos si es necesario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contacto - Biblioteca Universitaria</title>
</head>
<body>

<?php include 'header.php'; ?> <!-- Incluir el menú y la cabecera -->

<div class="content">
    <h2>Contacto</h2>
    <p>Puedes encontrarnos en nuestras redes sociales:</p>
    <ul>
        <li><a href="https://wa.me/tu_numero_de_whatsapp" target="_blank">WhatsApp</a></li>
        <li><a href="https://www.facebook.com/tu_pagina" target="_blank">Facebook</a></li>
        <li><a href="https://www.instagram.com/tu_perfil" target="_blank">Instagram</a></li>
    </ul>
</div>

<?php include 'footer.php'; ?> <!-- Incluir el footer -->

<script src="script.js"></script> <!-- Incluir el archivo JavaScript -->

</body>
</html>