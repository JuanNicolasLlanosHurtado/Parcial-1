<?php
// conexionBD.php - Conexión segura a MySQL con PDO
$host = "localhost";
$dbname = "parcial1";
$username = "root"; 
$password = "";     

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $conexion = new PDO($dsn, $username, $password, $opciones);
} catch (PDOException $e) {
    // En producción no muestres $e->getMessage() al usuario
    error_log("Error de conexión: " . $e->getMessage());
    die("Error crítico de conexión a la base de datos. Revisa que la BD 'mi_sitio' exista.");
}
?>
