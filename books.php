<?php
session_start();
include 'db.php'; // Asegúrate de incluir db.php para acceder a $pdo

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Manejar préstamo y devolución de libros
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST['prestamo'])) {
       // Prestar libro
       $libro_id = $_POST['libro_id'];
       $usuario_id = $_SESSION['user_id'];

       // Verificar si el libro está disponible
       $stmt = $pdo->prepare("SELECT estado FROM libros WHERE id = ?");
       $stmt->execute([$libro_id]);
       $libro = $stmt->fetch();

       if ($libro && $libro['estado'] == 'disponible') {
           // Actualizar estado del libro a prestado
           $stmt = $pdo->prepare("UPDATE libros SET estado = 'prestado' WHERE id = ?");
           $stmt->execute([$libro_id]);

           // Registrar préstamo en la tabla prestamos
           $stmt = $pdo->prepare("INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, NOW())");
           $stmt->execute([$usuario_id, $libro_id]);
           echo "Libro prestado con éxito.";
       } else {
           echo "El libro no está disponible.";
       }
   }
}

// Consultar libros disponibles
$stmt = $pdo->query("SELECT * FROM libros");
$libros = $stmt->fetchAll();

// Obtener información del usuario actual
$stmtUser = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmtUser->execute([$_SESSION['user_id']]);
$usuarioActual = $stmtUser->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Libros Disponibles</title>
</head>
<body>

<?php include 'header.php'; ?> <!-- Incluir el menú y la cabecera -->

<div class="content">
<h2>Libros Disponibles</h2>

<!-- Mostrar información del usuario -->
<div class="usuario-info">
   <h3>Bienvenido, <?php echo htmlspecialchars($usuarioActual['nombre']); ?></h3>
</div>

<table>
   <tr>
       <th>Título</th>
       <th>Autor</th>
       <th>Estado</th>
       <th>Acción</th>
   </tr>

   <?php foreach ($libros as $libro): ?>
       <tr>
           <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
           <td><?php echo htmlspecialchars($libro['autor']); ?></td>
           <td><?php echo htmlspecialchars($libro['estado']); ?></td>

           <?php if ($libro['estado'] == 'disponible'): ?>
               <td><form method="POST"><input type="hidden" name="libro_id" value="<?php echo htmlspecialchars($libro['id']); ?>"><button type="submit" name="prestamo">Prestar</button></form></td>

           <?php else: ?>
               <!-- Aquí podrías agregar un botón para devolver el libro -->
               <td>No disponible</td>

           <?php endif; ?>
       </tr>

   <?php endforeach; ?>

   </table>


<script src='script.js'></script>

<?php include 'footer.php'; ?> <!-- Incluir el footer -->

</body>
</html>