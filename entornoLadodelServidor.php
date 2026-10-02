<?php
// entornoLadodelServidor.php - Lógica del servidor (Controlador)
// Este archivo SIEMPRE se incluye antes del HTML

require_once __DIR__ . '/conexionBD.php';

// 1. Detectamos sección con lista blanca (seguridad)
$secciones_permitidas = ['inicio', 'servicios', 'contacto'];
$seccion_actual = $_GET['seccion'] ?? 'inicio';
$seccion_actual = strtolower(trim($seccion_actual));

if (!in_array($seccion_actual, $secciones_permitidas)) {
    $seccion_actual = '404';
}

// 2. Variable para mensajes de la BD
$mensaje_db = "";

// 3. Lógica de guardado SOLO si estamos en contacto y es POST
if ($seccion_actual === 'contacto' && $_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_contacto = trim($_POST['nombre'] ?? '');

    if (!empty($nombre_contacto) && mb_strlen($nombre_contacto) >= 2) {
        try {
            $sql = "INSERT INTO contactos (nombre) VALUES (:nombre)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':nombre' => $nombre_contacto]);
            $mensaje_db = "<p class='alerta exito'>¡Mensaje guardado con éxito en la Base de Datos!</p>";
        } catch (PDOException $e) {
            error_log("Error INSERT: " . $e->getMessage());
            $mensaje_db = "<p class='alerta error'>Error al guardar en la BD: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        $mensaje_db = "<p class='alerta error'>Por favor, escribe un nombre válido (mínimo 2 caracteres).</p>";
    }
}

// Para listar contactos en admin si quieres:
$lista_contactos = [];
try {
    $lista_contactos = $conexion->query("SELECT * FROM contactos ORDER BY fecha_registro DESC LIMIT 20")->fetchAll();
} catch (Exception $e) {}
?>
