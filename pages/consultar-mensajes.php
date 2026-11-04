<?php
require __DIR__ . '/../php/conexion.php';

$resultado = $conexion->query(
    'SELECT nombre, correo, asunto, mensaje, fecha_registro
     FROM mensajes
     ORDER BY fecha_registro DESC, id DESC'
);
$mensajes = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFRZ - Mensajes de contacto</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <main>
    <h1>Mensajes de contacto</h1>

    <?php if (count($mensajes) === 0): ?>
      <p>No existen mensajes registrados.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Asunto</th>
            <th>Mensaje</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($mensajes as $m): ?>
            <tr>
              <td><?= htmlspecialchars($m['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
              <td><?= htmlspecialchars($m['correo'], ENT_QUOTES, 'UTF-8') ?></td>
              <td><?= htmlspecialchars($m['asunto'], ENT_QUOTES, 'UTF-8') ?></td>
              <td><?= nl2br(htmlspecialchars($m['mensaje'], ENT_QUOTES, 'UTF-8')) ?></td>
              <td><?= htmlspecialchars($m['fecha_registro'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <p><a href="contacto.html">Volver al formulario</a></p>
  </main>
</body>
</html>
