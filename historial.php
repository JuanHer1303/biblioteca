<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Historial de Préstamos</title>
</head>
<body>

<?php include 'header.php'; ?> <!-- Incluir el menú y la cabecera -->

<div class="content">
    <h2>Historial de Préstamos</h2>
    <?php if (empty($historial)): ?>
        <p>No tienes historial de préstamos.</p> <!-- Mensaje si no hay historial -->
    <?php else: ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
            </tr>
            <?php foreach ($historial as $prestamo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($prestamo['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($prestamo['autor']); ?></td>
                    <td><?php echo htmlspecialchars($prestamo['fecha_prestamo']); ?></td>
                    <td><?php echo htmlspecialchars($prestamo['fecha_devolucion'] ?? 'No devuelto'); ?></td> <!-- Muestra 'No devuelto' si no hay fecha -->
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?> <!-- Incluir el footer -->

<script src="script.js"></script> <!-- Incluir el archivo JavaScript -->

</body>
</html>