<?php
// Iniciar la sesión solo si no está activa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<header>
    <h1>Bienvenido a la Biblioteca Universitaria</h1>
    <p>Gestiona el préstamo de libros de manera fácil y rápida.</p>
</header>

<nav>
    <ul>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <li><a href="index.php">Inicio</a></li> <!-- Enlace a la página principal -->
            <li><a href="contacto.php">Contacto</a></li> <!-- Enlace al apartado de contacto -->
            <li><a href="register.php">Registrar Usuario</a></li>
            <li><a href="login.php">Iniciar Sesión</a></li>
        <?php else: ?>
            <li><a href="index.php">Inicio</a></li> <!-- Enlace a la página principal -->
            <li><a href="contacto.php">Contacto</a></li> <!-- Enlace al apartado de contacto -->
            <li><a href="reservados.php">Libros Reservados</a></li> <!-- Enlace a los libros reservados -->
            <li><a href="historial.php">Historial de Préstamos</a></li> <!-- Enlace al historial -->
            <li><a href="books.php">Ver Libros</a></li> <!-- Enlace para ver libros -->
            <li><a href="logout.php">Cerrar Sesión</a></li> <!-- Opción para cerrar sesión -->
        <?php endif; ?>
        
    </ul>
</nav>
