<?php
require __DIR__ . '/../php/conexion.php';

// Solo se procesan envíos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacto.html');
    exit;
}

// Recoger y limpiar datos
$nombre  = trim($_POST['nombre']  ?? '');
$correo  = trim($_POST['correo']  ?? '');
$asunto  = trim($_POST['asunto']  ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validación en el servidor
$errores = [];

if ($nombre === '') {
    $errores[] = 'El nombre completo es obligatorio.';
} elseif (mb_strlen($nombre) > 100) {
    $errores[] = 'El nombre no puede superar los 100 caracteres.';
}

if ($correo === '') {
    $errores[] = 'El correo electrónico es obligatorio.';
} elseif (mb_strlen($correo) > 150) {
    $errores[] = 'El correo no puede superar los 150 caracteres.';
} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El formato del correo electrónico no es válido.';
}

if ($asunto === '') {
    $errores[] = 'El asunto es obligatorio.';
} elseif (mb_strlen($asunto) > 150) {
    $errores[] = 'El asunto no puede superar los 150 caracteres.';
}

if ($mensaje === '') {
    $errores[] = 'El mensaje es obligatorio.';
} elseif (mb_strlen($mensaje) > 2000) {
    $errores[] = 'El mensaje no puede superar los 2000 caracteres.';
}

$guardado = false;

// Solo se guarda si todo es válido
if (empty($errores)) {
    try {
        $sql  = 'INSERT INTO mensajes (nombre, correo, asunto, mensaje) VALUES (?, ?, ?, ?)';
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ssss', $nombre, $correo, $asunto, $mensaje);
        $stmt->execute();
        $guardado = $stmt->affected_rows === 1;
        $stmt->close();
    } catch (Throwable $e) {
        $guardado = false;
    }

    if (!$guardado) {
        $errores[] = 'No se pudo guardar el mensaje. Inténtalo de nuevo más tarde.';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFRZ - Contacto</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <main>
    <?php if ($guardado): ?>
      <h1>Mensaje enviado</h1>
      <p>Gracias, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>. Tu mensaje se guardó correctamente.</p>
      <p><a href="consultar-mensajes.php">Ver mensajes guardados</a></p>
    <?php else: ?>
      <h1>No se pudo enviar el mensaje</h1>
      <ul>
        <?php foreach ($errores as $error): ?>
          <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
      </ul>
      <p><a href="contacto.html">Volver al formulario</a></p>
    <?php endif; ?>
  </main>
</body>
</html>
