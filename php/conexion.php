<?php
// Conexión a la base de datos local (XAMPP)
$servidor = 'localhost';
$usuario  = 'root';
$clave    = '';
$base     = 'contacto_web';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexion = new mysqli($servidor, $usuario, $clave, $base);
$conexion->set_charset('utf8mb4');
